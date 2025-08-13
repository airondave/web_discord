<?php

namespace App\Mail;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TopupRejection extends Mailable
{
    use Queueable, SerializesModels;

    public $transaction;
    public $rejectionReason;

    public function __construct(Transaction $transaction, $rejectionReason)
    {
        $this->transaction = $transaction;
        $this->rejectionReason = $rejectionReason;
    }

    public function build()
    {
        return $this->markdown('emails.topup_rejection')
                    ->subject('Topup Rejected - ' . $this->transaction->game->name)
                    ->with([
                        'transaction' => $this->transaction,
                        'rejectionReason' => $this->rejectionReason,
                    ]);
    }
} 