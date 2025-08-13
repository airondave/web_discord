@component('mail::message')
# Topup Confirmed! 🎮

Dear {{ $transaction->buyer_name }},

Your topup transaction has been **confirmed** and is now being processed!

## Transaction Details:
- **Game:** {{ $transaction->game->name }}
- **Package:** {{ $transaction->topupPackage->name }}
- **Amount:** {{ number_format($transaction->topupPackage->amount) }} {{ $transaction->game->currency_unit }}
- **Player ID:** {{ $transaction->player_id }}
@if($transaction->player_server)
- **Server:** {{ $transaction->player_server }}
@endif
- **Price:** Rp {{ number_format($transaction->price, 0, ',', '.') }}
- **Transaction ID:** {{ $transaction->id }}

## What happens next?
Your topup will be processed within **1x24 hours**. You will receive another notification once the items have been added to your account.

## Need help?
If you have any questions, please contact our support team.

Thank you for choosing our service!

Best regards, Ranconnity<br>
{{ config('app.name') }}

---
*This is an automated message. Please do not reply to this email.*
@endcomponent 