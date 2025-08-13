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
        return view('admin.topup.packages', compact('packages'));
    }

    public function paymentMethods()
    {
        $paymentMethods = PaymentMethod::all();
        return view('admin.topup.payment-methods', compact('paymentMethods'));
    }
} 