@component('mail::message')
# Topup Rejected ❌

Dear {{ $transaction->buyer_name }},

Unfortunately, your topup transaction has been **rejected**.

## Transaction Details:
- **Game:** {{ $transaction->game->name }}
- **Package:** {{ $transaction->topupPackage->name }}
- **Amount:** {{ number_format($transaction->topupPackage->amount) }} {{ $transaction->game->currency_unit }}
- **Player ID:** {{ $transaction->player_id }}
@if($transaction->player_server)
- **Server:** {{ $transaction->player_server }}
@endif
- **Price:** Rp {{ number_format($transaction->price, 2, ',', '.') }}
- **Transaction ID:** {{ $transaction->id }}

## Reason for Rejection:
{{ $rejectionReason }}

## What happens next?
- Your payment will be refunded according to our refund policy
- You may try to make a new transaction if the issue can be resolved
- If you believe this is an error, please contact our support team

## Need help?
If you have any questions about this rejection or need assistance, please contact our support team on discord.

We apologize for any inconvenience this may have caused.

Best regards, Ranconnity<br>
{{ config('app.name') }}

---
*This is an automated message. Please do not reply to this email.*
@endcomponent 