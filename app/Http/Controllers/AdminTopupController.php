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

    public function packages()
    {
        $packages = TopupPackage::with('game')->get();
        return view('admin.topup.packages', compact('packages'));
    }

    public function paymentMethods()
    {
        $paymentMethods = PaymentMethod::all();
        return view('admin.topup.payment-methods', compact('paymentMethods'));
    }
} 