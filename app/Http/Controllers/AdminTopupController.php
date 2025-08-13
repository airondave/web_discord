<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Game;
use App\Models\TopupPackage;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TopupConfirmation;
use App\Mail\TopupRejection;

class AdminTopupController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['game', 'topupPackage', 'paymentMethod', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.topup.index', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = Transaction::with(['game', 'topupPackage', 'paymentMethod', 'user'])
            ->findOrFail($id);

        return view('admin.topup.show', compact('transaction'));
    }

    public function getDetails($id)
    {
        $transaction = Transaction::with(['game', 'topupPackage', 'paymentMethod', 'user'])
            ->findOrFail($id);

        // Determine status classes and text
        $statusClass = match($transaction->status) {
            'pending' => 'secondary',
            'paid' => 'warning',
            'delivered' => 'success',
            'failed' => 'danger',
            default => 'secondary'
        };

        $statusText = ucfirst($transaction->status);

        $paymentStatusClass = $transaction->status === 'pending' ? 'secondary' : 
                            ($transaction->status === 'paid' ? 'success' : 
                            ($transaction->status === 'delivered' ? 'success' : 'danger'));

        $paymentStatusText = $transaction->status === 'pending' ? 'Pending' : 
                           ($transaction->status === 'paid' ? 'Paid' : 
                           ($transaction->status === 'delivered' ? 'Completed' : 'Failed'));

        $deliveryStatusClass = $transaction->status === 'delivered' ? 'success' : 
                             ($transaction->status === 'failed' ? 'danger' : 'secondary');

        $deliveryStatusText = $transaction->status === 'delivered' ? 'Delivered' : 
                            ($transaction->status === 'failed' ? 'Failed' : 'Pending');

        return response()->json([
            'success' => true,
            'transaction' => [
                'id' => $transaction->id,
                'user' => $transaction->user ? [
                    'name' => $transaction->user->name,
                    'email' => $transaction->user->email
                ] : null,
                'buyer_name' => $transaction->buyer_name,
                'buyer_email' => $transaction->buyer_email,
                'game' => [
                    'name' => $transaction->game->name
                ],
                'topupPackage' => [
                    'name' => $transaction->topupPackage->name,
                    'amount' => $transaction->topupPackage->amount,
                    'price' => $transaction->topupPackage->price
                ],
                'player_id' => $transaction->player_id,
                'player_server' => $transaction->player_server,
                'price' => $transaction->price,
                'status' => $transaction->status,
                'status_class' => $statusClass,
                'status_text' => $statusText,
                'created_at' => $transaction->created_at->format('d/m/Y H:i'),
                'updated_at' => $transaction->updated_at->format('d/m/Y H:i'),
                'payment_method' => $transaction->paymentMethod->name,
                'payment_status_class' => $paymentStatusClass,
                'payment_status_text' => $paymentStatusText,
                'payment_date' => $transaction->status === 'paid' || $transaction->status === 'delivered' ? 
                                $transaction->updated_at->format('d/m/Y H:i') : 'Not paid yet',
                'delivery_status_class' => $deliveryStatusClass,
                'delivery_status_text' => $deliveryStatusText,
                'delivery_date' => $transaction->status === 'delivered' ? 
                                 $transaction->updated_at->format('d/m/Y H:i') : 'Not delivered yet',
                'notes' => $transaction->payment_reference ? 
                          'Payment Reference: ' . $transaction->payment_reference : null
            ]
        ]);
    }

    public function process($id)
    {
        $transaction = Transaction::findOrFail($id);
        
        if ($transaction->status !== 'paid') {
            return redirect()->route('admin.topup.index')
                ->with('error', 'Only paid transactions can be processed.');
        }

        // Update status to delivered
        $transaction->update(['status' => 'delivered']);

        // Send confirmation email
        if ($transaction->buyer_email) {
            Mail::to($transaction->buyer_email)->send(new TopupConfirmation($transaction));
        }

        return redirect()->route('admin.topup.index')
            ->with('success', 'Transaction processed successfully! Confirmation email sent.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $transaction = Transaction::findOrFail($id);
        
        if ($transaction->status !== 'paid') {
            return redirect()->route('admin.topup.index')
                ->with('error', 'Only paid transactions can be rejected.');
        }

        // Update status to failed
        $transaction->update([
            'status' => 'failed',
            'payment_reference' => $transaction->payment_reference . '_REJECTED_' . time(),
        ]);

        // Send rejection email
        if ($transaction->buyer_email) {
            Mail::to($transaction->buyer_email)->send(new TopupRejection($transaction, $request->rejection_reason));
        }

        return redirect()->route('admin.topup.index')
            ->with('success', 'Transaction rejected successfully! Rejection email sent.');
    }

    public function games()
    {
        $games = Game::with('topupPackages')->get();
        return view('admin.topup.games', compact('games'));
    }

    public function paymentMethods()
    {
        $paymentMethods = PaymentMethod::all();
        return view('admin.topup.payment-methods', compact('paymentMethods'));
    }

    // Package Management Methods
    public function packages(Request $request)
    {
        $query = TopupPackage::with('game');
        
        // Search by package name
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }
        
        // Filter by game
        if ($request->filled('game')) {
            $query->where('game_id', $request->game);
        }
        
        $packages = $query->orderBy('created_at', 'desc')->paginate(20);
        
        // Append search and filter parameters to pagination links
        if ($request->filled('search')) {
            $packages->appends(['search' => $request->search]);
        }
        if ($request->filled('game')) {
            $packages->appends(['game' => $request->game]);
        }
        
        $games = Game::all();
        return view('admin.topup.packages', compact('packages', 'games'));
    }

    public function createPackage()
    {
        $games = Game::all();
        return view('admin.topup.packages.create', compact('games'));
    }

    public function storePackage(Request $request)
    {
        // Simple logging for debugging
        \Log::info('Package creation request received', ['data' => $request->all()]);
        
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'name' => 'required|string|max:100',
            'amount' => 'required|integer|min:1',
            'price' => 'required|integer|min:1000',
        ]);
        
        \Log::info('Validation passed successfully');

        try {
            $package = TopupPackage::create([
                'game_id' => $request->game_id,
                'name' => $request->name,
                'amount' => $request->amount,
                'price' => $request->price,
                'is_active' => true, // Always active by default
            ]);
            
            \Log::info('Package created successfully:', $package->toArray());
            
            return redirect()->route('admin.topup.packages')
                ->with('success', 'Package created successfully!');
        } catch (\Exception $e) {
            \Log::error('Package creation failed:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create package: ' . $e->getMessage());
        }
    }

    public function editPackage($id)
    {
        $package = TopupPackage::with('game')->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'package' => $package
        ]);
    }

    public function updatePackage(Request $request, $id)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'name' => 'required|string|max:100',
            'amount' => 'required|integer|min:1',
            'price' => 'required|integer|min:1000',
        ]);

        $package = TopupPackage::findOrFail($id);
        $package->update([
            'game_id' => $request->game_id,
            'name' => $request->name,
            'amount' => $request->amount,
            'price' => $request->price,
            'is_active' => true, // Always active by default
        ]);

        return redirect()->route('admin.topup.packages')
            ->with('success', 'Package updated successfully!');
    }

    public function destroyPackage($id)
    {
        $package = TopupPackage::findOrFail($id);
        
        // Check if package is being used in transactions
        if ($package->transactions()->count() > 0) {
            return redirect()->route('admin.topup.packages')
                ->with('error', 'Cannot delete package. It is being used in transactions.');
        }

        $package->delete();

        return redirect()->route('admin.topup.packages')
            ->with('success', 'Package deleted successfully!');
    }

    public function togglePackageStatus(Request $request, $id)
    {
        $package = TopupPackage::findOrFail($id);
        $package->update(['is_active' => $request->is_active]);

        return response()->json([
            'success' => true,
            'message' => 'Package status updated successfully!'
        ]);
    }

    // Games Management Methods
    public function storeGame(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:games,name',
            'publisher' => 'required|string|max:100',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'publisher' => $request->publisher,
        ];

        // Handle icon upload
        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $iconName = time() . '_' . $icon->getClientOriginalName();
            $icon->move(public_path('image/games'), $iconName);
            $data['icon'] = $iconName;
        }

        Game::create($data);

        return redirect()->route('admin.topup.games')
            ->with('success', 'Game created successfully!');
    }

    public function updateGame(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:games,name,' . $id,
            'publisher' => 'required|string|max:100',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $game = Game::findOrFail($id);
        $data = [
            'name' => $request->name,
            'publisher' => $request->publisher,
        ];

        // Handle icon upload
        if ($request->hasFile('icon')) {
            // Delete old icon if exists
            if ($game->icon && file_exists(public_path('image/games/' . $game->icon))) {
                unlink(public_path('image/games/' . $game->icon));
            }
            
            $icon = $request->file('icon');
            $iconName = time() . '_' . $icon->getClientOriginalName();
            $icon->move(public_path('image/games'), $iconName);
            $data['icon'] = $iconName;
        }

        $game->update($data);

        return redirect()->route('admin.topup.games')
            ->with('success', 'Game updated successfully!');
    }

    public function destroyGame($id)
    {
        $game = Game::findOrFail($id);
        
        // Check if game has packages
        if ($game->topupPackages()->count() > 0) {
            return redirect()->route('admin.topup.games')
                ->with('error', 'Cannot delete game. It has associated packages.');
        }

        // Delete icon file if exists
        if ($game->icon && file_exists(public_path('image/games/' . $game->icon))) {
            unlink(public_path('image/games/' . $game->icon));
        }

        $game->delete();

        return redirect()->route('admin.topup.games')
            ->with('success', 'Game deleted successfully!');
    }

    // Payment Methods Management Methods
    public function storePaymentMethod(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:payment_methods,name',
            'type' => 'required|in:qris,ewallet,bank,cash',
        ]);

        PaymentMethod::create([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        return redirect()->route('admin.topup.payment-methods')
            ->with('success', 'Payment method created successfully!');
        }

    public function updatePaymentMethod(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:payment_methods,name,' . $id,
            'type' => 'required|in:qris,ewallet,bank,cash',
        ]);

        $method = PaymentMethod::findOrFail($id);
        $method->update([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        return redirect()->route('admin.topup.payment-methods')
            ->with('success', 'Payment method updated successfully!');
    }

    public function destroyPaymentMethod($id)
    {
        $method = PaymentMethod::findOrFail($id);
        
        // Check if payment method is being used in transactions
        if ($method->transactions()->count() > 0) {
            return redirect()->route('admin.topup.payment-methods')
                ->with('error', 'Cannot delete payment method. It is being used in transactions.');
        }

        $method->delete();

        return redirect()->route('admin.topup.payment-methods')
            ->with('success', 'Payment method updated successfully!');
    }
} 