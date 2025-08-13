@component('mail::message')
<div style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 40px 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <!-- Header with melancholic design -->
    <div style="text-align: center; margin-bottom: 30px; padding: 20px; background: rgba(108, 117, 125, 0.1); border-radius: 12px; border-left: 4px solid #dc3545;">
        <div style="font-size: 48px; margin-bottom: 10px; opacity: 0.7;">😔</div>
        <h1 style="color: #6c757d; margin: 0; font-size: 28px; font-weight: 300; letter-spacing: 1px;">Topup Rejected</h1>
        <div style="color: #dc3545; font-size: 14px; margin-top: 8px; opacity: 0.8;">Transaction Unsuccessful</div>
    </div>

    <!-- Greeting -->
    <div style="background: white; padding: 25px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border-left: 3px solid #6c757d;">
        <p style="color: #495057; font-size: 16px; margin: 0; line-height: 1.6;">
            Dear <strong style="color: #343a40;">{{ $transaction->buyer_name }}</strong>,
        </p>
        <p style="color: #6c757d; font-size: 15px; margin: 15px 0 0 0; line-height: 1.6;">
            Unfortunately, your topup transaction has been <strong style="color: #dc3545;">rejected</strong>.
        </p>
    </div>

    <!-- Transaction Details -->
    <div style="background: white; padding: 25px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border-left: 3px solid #6c757d;">
        <h2 style="color: #495057; font-size: 18px; margin: 0 0 20px 0; font-weight: 500; display: flex; align-items: center;">
            <span style="background: #6c757d; width: 6px; height: 6px; border-radius: 50%; margin-right: 12px; opacity: 0.6;"></span>
            Transaction Details
        </h2>
        <div style="display: grid; gap: 12px;">
            <div style="display: flex; justify-content: space-between; padding: 12px; background: #f8f9fa; border-radius: 6px; border-left: 3px solid #dee2e6;">
                <span style="color: #6c757d; font-weight: 500;">Game:</span>
                <span style="color: #495057;">{{ $transaction->game->name }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; padding: 12px; background: #f8f9fa; border-radius: 6px; border-left: 3px solid #dee2e6;">
                <span style="color: #6c757d; font-weight: 500;">Package:</span>
                <span style="color: #495057;">{{ $transaction->topupPackage->name }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; padding: 12px; background: #f8f9fa; border-radius: 6px; border-left: 3px solid #dee2e6;">
                <span style="color: #6c757d; font-weight: 500;">Amount:</span>
                <span style="color: #495057;">{{ number_format($transaction->topupPackage->amount) }} {{ $transaction->game->currency_unit }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; padding: 12px; background: #f8f9fa; border-radius: 6px; border-left: 3px solid #dee2e6;">
                <span style="color: #6c757d; font-weight: 500;">Player ID:</span>
                <span style="color: #495057;">{{ $transaction->player_id }}</span>
            </div>
            @if($transaction->player_server)
            <div style="display: flex; justify-content: space-between; padding: 12px; background: #f8f9fa; border-radius: 6px; border-left: 3px solid #dee2e6;">
                <span style="color: #6c757d; font-weight: 500;">Server:</span>
                <span style="color: #495057;">{{ $transaction->player_server }}</span>
            </div>
            @endif
            <div style="display: flex; justify-content: space-between; padding: 12px; background: #f8f9fa; border-radius: 6px; border-left: 3px solid #dee2e6;">
                <span style="color: #6c757d; font-weight: 500;">Price:</span>
                <span style="color: #495057;">Rp {{ number_format($transaction->price, 2, ',', '.') }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; padding: 12px; background: #f8f9fa; border-radius: 6px; border-left: 3px solid #dee2e6;">
                <span style="color: #6c757d; font-weight: 500;">Transaction ID:</span>
                <span style="color: #495057; font-family: monospace;">{{ $transaction->id }}</span>
            </div>
        </div>
    </div>

    <!-- Rejection Reason -->
    <div style="background: white; padding: 25px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border-left: 3px solid #dc3545;">
        <h2 style="color: #495057; font-size: 18px; margin: 0 0 20px 0; font-weight: 500; display: flex; align-items: center;">
            <span style="background: #dc3545; width: 6px; height: 6px; border-radius: 50%; margin-right: 12px;"></span>
            Reason for Rejection
        </h2>
        <div style="background: #fff5f5; padding: 15px; border-radius: 6px; border: 1px solid #fed7d7;">
            <p style="color: #c53030; margin: 0; font-size: 15px; line-height: 1.6;">{{ $rejectionReason }}</p>
        </div>
    </div>

    <!-- Next Steps -->
    <div style="background: white; padding: 25px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border-left: 3px solid #6c757d;">
        <h2 style="color: #495057; font-size: 18px; margin: 0 0 20px 0; font-weight: 500; display: flex; align-items: center;">
            <span style="background: #6c757d; width: 6px; height: 6px; border-radius: 50%; margin-right: 12px; opacity: 0.6;"></span>
            What happens next?
        </h2>
        <ul style="color: #6c757d; font-size: 15px; line-height: 1.8; margin: 0; padding-left: 20px;">
            <li style="margin-bottom: 8px;">Your payment will be refunded according to our refund policy</li>
            <li style="margin-bottom: 8px;">You may try to make a new transaction if the issue can be resolved</li>
            <li style="margin-bottom: 0;">If you believe this is an error, please contact our support team</li>
        </ul>
    </div>

    <!-- Support Section -->
    <div style="background: white; padding: 25px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border-left: 3px solid #6c757d;">
        <h2 style="color: #495057; font-size: 18px; margin: 0 0 20px 0; font-weight: 500; display: flex; align-items: center;">
            <span style="background: #6c757d; width: 6px; height: 6px; border-radius: 50%; margin-right: 12px; opacity: 0.6;"></span>
            Need help?
        </h2>
        <p style="color: #6c757d; font-size: 15px; margin: 0; line-height: 1.6;">
            If you have any questions about this rejection or need assistance, please contact our support team on discord.
        </p>
    </div>

    <!-- Apology and Footer -->
    <div style="text-align: center; padding: 25px; background: rgba(108, 117, 125, 0.05); border-radius: 8px; border: 1px solid rgba(108, 117, 125, 0.1);">
        <p style="color: #6c757d; font-size: 15px; margin: 0 0 20px 0; line-height: 1.6; font-style: italic;">
            We apologize for any inconvenience this may have caused.
        </p>
        <div style="color: #495057; font-size: 16px; margin-bottom: 5px;">
            Best regards, <strong>Ranconnity</strong>
        </div>
        <div style="color: #6c757d; font-size: 14px;">{{ config('app.name') }}</div>
    </div>

    <!-- Disclaimer -->
    <div style="text-align: center; margin-top: 30px; padding: 15px; background: rgba(108, 117, 125, 0.05); border-radius: 6px;">
        <p style="color: #6c757d; font-size: 12px; margin: 0; opacity: 0.7; font-style: italic;">
            This is an automated message. Please do not reply to this email.
        </p>
    </div>
</div>
@endcomponent 