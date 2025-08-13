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

    public function packages()
    {
        $packages = TopupPackage::with('game')->get();
        $games = Game::all();
        return view('admin.topup.packages', compact('packages', 'games'));
    }

    public function paymentMethods()
    {
        $paymentMethods = PaymentMethod::all();
        return view('admin.topup.payment_methods', compact('paymentMethods'));
    }

    // Game Management
    public function storeGame(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
        ]);

        Game::create($request->all());

        return redirect()->route('admin.topup.games')
            ->with('success', 'Game created successfully!');
    }

    public function updateGame(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
        ]);

        $game = Game::findOrFail($id);
        $game->update($request->all());

        return redirect()->route('admin.topup.games')
            ->with('success', 'Game updated successfully!');
    }

    public function destroyGame($id)
    {
        $game = Game::findOrFail($id);
        $game->delete();

        return redirect()->route('admin.topup.games')
            ->with('success', 'Game deleted successfully!');
    }

    public function getGamePackages($id)
    {
        $packages = TopupPackage::where('game_id', $id)->get();
        return response()->json($packages);
    }

    // Package Management
    public function storePackage(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'name' => 'required|string|max:255',
            'amount' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        TopupPackage::create($request->all());

        return redirect()->route('admin.topup.packages')
            ->with('success', 'Package created successfully!');
    }

    public function updatePackage(Request $request, $id)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'name' => 'required|string|max:255',
            'amount' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $package = TopupPackage::findOrFail($id);
        $package->update($request->all());

        return redirect()->route('admin.topup.packages')
            ->with('success', 'Package updated successfully!');
    }

    public function destroyPackage($id)
    {
        $package = TopupPackage::findOrFail($id);
        $package->delete();

        return redirect()->route('admin.topup.packages')
            ->with('success', 'Package deleted successfully!');
    }

    // Payment Method Management
    public function storePaymentMethod(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:qris,bank,ewallet',
        ]);

        PaymentMethod::create($request->all());

        return redirect()->route('admin.topup.payment-methods')
            ->with('success', 'Payment method created successfully!');
    }

    public function updatePaymentMethod(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:qris,bank,ewallet',
        ]);

        $paymentMethod = PaymentMethod::findOrFail($id);
        $paymentMethod->update($request->all());

        return redirect()->route('admin.topup.payment-methods')
            ->with('success', 'Payment method updated successfully!');
    }

    public function destroyPaymentMethod($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $paymentMethod->delete();

        return redirect()->route('admin.topup.payment-methods')
            ->with('success', 'Payment method deleted successfully!');
    }
} 