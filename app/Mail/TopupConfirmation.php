<?php

namespace App\Mail;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TopupConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function build()
    {
        return $this->markdown('emails.topup_confirmation')
                    ->subject('Topup Confirmed - ' . $this->transaction->game->name)
                    ->with([
                        'transaction' => $this->transaction,
                    ]);
    }
} 