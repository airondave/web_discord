<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\TopupPackage;
use App\Models\PaymentMethod;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TopupConfirmation;
use App\Mail\TopupRejection;

class TopupController extends Controller
{
    public function index()
    {
        $games = Game::with('topupPackages')->get();
        $paymentMethods = PaymentMethod::all();
        
        return view('topup.index', compact('games', 'paymentMethods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'package_id' => 'required|exists:topup_packages,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'player_id' => 'required|string|max:100',
            'player_server' => 'nullable|string|max:100',
            'buyer_name' => 'nullable|string|max:100',
            'buyer_email' => 'nullable|email|max:150',
        ]);

        // Get package details
        $package = TopupPackage::findOrFail($request->package_id);
        
        // Create transaction
        $transaction = Transaction::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'buyer_name' => $request->buyer_name ?: (Auth::check() ? Auth::user()->name : null),
            'buyer_email' => $request->buyer_email ?: (Auth::check() ? Auth::user()->email : null),
            'game_id' => $request->game_id,
            'package_id' => $request->package_id,
            'payment_method_id' => $request->payment_method_id,
            'player_id' => $request->player_id,
            'player_server' => $request->player_server,
            'price' => $package->price,
            'status' => 'pending',
        ]);

        return redirect()->route('topup.payment', $transaction->id)
            ->with('success', 'Transaction created successfully! Please complete your payment.');
    }

    public function payment($id)
    {
        $transaction = Transaction::with(['game', 'topupPackage', 'paymentMethod'])->findOrFail($id);
        
        if ($transaction->status !== 'pending') {
            return redirect()->route('topup.index')
                ->with('error', 'This transaction cannot be processed.');
        }

        return view('topup.payment', compact('transaction'));
    }

    public function confirmPayment(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        
        if ($transaction->status !== 'pending') {
            return redirect()->route('topup.index')
                ->with('error', 'This transaction cannot be processed.');
        }

        // Update status to paid
        $transaction->update([
            'status' => 'paid',
            'payment_reference' => 'QRIS_' . time() . '_' . $transaction->id,
        ]);

        return redirect()->route('topup.success', $transaction->id)
            ->with('success', 'Payment confirmed! Please wait for admin verification.');
    }

    public function success($id)
    {
        $transaction = Transaction::with(['game', 'topupPackage'])->findOrFail($id);
        return view('topup.success', compact('transaction'));
    }
} 