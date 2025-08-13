@component('mail::message')
<div style="background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 50%, #e8f5e8 100%); padding: 40px 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <!-- Header with celebratory design -->
    <div style="text-align: center; margin-bottom: 30px; padding: 25px; background: linear-gradient(135deg, #4caf50 0%, #66bb6a 100%); border-radius: 16px; box-shadow: 0 8px 25px rgba(76, 175, 80, 0.3); position: relative; overflow: hidden;">
        <!-- Celebration elements -->
        <div style="position: absolute; top: -10px; left: -10px; font-size: 24px; opacity: 0.6;">🎉</div>
        <div style="position: absolute; top: -5px; right: -5px; font-size: 20px; opacity: 0.6;">✨</div>
        <div style="position: absolute; bottom: -8px; left: 20px; font-size: 18px; opacity: 0.6;">🎊</div>
        <div style="position: absolute; bottom: -5px; right: 20px; font-size: 22px; opacity: 0.6;">🎯</div>
        
        <div style="font-size: 52px; margin-bottom: 15px;">🎮</div>
        <h1 style="color: white; margin: 0; font-size: 32px; font-weight: 600; letter-spacing: 1px; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">Topup Confirmed!</h1>
        <div style="color: #e8f5e8; font-size: 16px; margin-top: 10px; opacity: 0.9; font-weight: 500;">Transaction Successful! 🚀</div>
    </div>

    <!-- Greeting -->
    <div style="background: white; padding: 28px; border-radius: 12px; margin-bottom: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border-left: 4px solid #4caf50;">
        <p style="color: #2e7d32; font-size: 17px; margin: 0; line-height: 1.6;">
            Dear <strong style="color: #1b5e20;">{{ $transaction->buyer_name }}</strong>,
        </p>
        <p style="color: #388e3c; font-size: 16px; margin: 15px 0 0 0; line-height: 1.6;">
            Your topup transaction has been <strong style="color: #4caf50;">confirmed</strong> and is now being processed!
        </p>
    </div>

    <!-- Transaction Details -->
    <div style="background: white; padding: 28px; border-radius: 12px; margin-bottom: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border-left: 4px solid #4caf50;">
        <h2 style="color: #2e7d32; font-size: 20px; margin: 0 0 25px 0; font-weight: 600; display: flex; align-items: center;">
            <span style="background: #4caf50; width: 8px; height: 8px; border-radius: 50%; margin-right: 15px; box-shadow: 0 0 8px rgba(76, 175, 80, 0.4);"></span>
            Transaction Details
        </h2>
        <div style="display: grid; gap: 15px;">
            <div style="display: flex; justify-content: space-between; padding: 15px; background: linear-gradient(135deg, #f1f8e9 0%, #e8f5e8 100%); border-radius: 8px; border-left: 4px solid #81c784;">
                <span style="color: #558b2f; font-weight: 600;">Game:</span>
                <span style="color: #2e7d32; font-weight: 500;">{{ $transaction->game->name }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; padding: 15px; background: linear-gradient(135deg, #f1f8e9 0%, #e8f5e8 100%); border-radius: 8px; border-left: 4px solid #81c784;">
                <span style="color: #558b2f; font-weight: 600;">Package:</span>
                <span style="color: #2e7d32; font-weight: 500;">{{ $transaction->topupPackage->name }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; padding: 15px; background: linear-gradient(135deg, #f1f8e9 0%, #e8f5e8 100%); border-radius: 8px; border-left: 4px solid #81c784;">
                <span style="color: #558b2f; font-weight: 600;">Amount:</span>
                <span style="color: #2e7d32; font-weight: 500;">{{ number_format($transaction->topupPackage->amount) }} {{ $transaction->game->currency_unit }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; padding: 15px; background: linear-gradient(135deg, #f1f8e9 0%, #e8f5e8 100%); border-radius: 8px; border-left: 4px solid #81c784;">
                <span style="color: #558b2f; font-weight: 600;">Player ID:</span>
                <span style="color: #2e7d32; font-weight: 500;">{{ $transaction->player_id }}</span>
            </div>
            @if($transaction->player_server)
            <div style="display: flex; justify-content: space-between; padding: 15px; background: linear-gradient(135deg, #f1f8e9 0%, #e8f5e8 100%); border-radius: 8px; border-left: 4px solid #81c784;">
                <span style="color: #558b2f; font-weight: 600;">Server:</span>
                <span style="color: #2e7d32; font-weight: 500;">{{ $transaction->player_server }}</span>
            </div>
            @endif
            <div style="display: flex; justify-content: space-between; padding: 15px; background: linear-gradient(135deg, #f1f8e9 0%, #e8f5e8 100%); border-radius: 8px; border-left: 4px solid #81c784;">
                <span style="color: #558b2f; font-weight: 600;">Price:</span>
                <span style="color: #2e7d32; font-weight: 500;">Rp {{ number_format($transaction->price, 2, ',', '.') }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; padding: 15px; background: linear-gradient(135deg, #f1f8e9 0%, #e8f5e8 100%); border-radius: 8px; border-left: 4px solid #81c784;">
                <span style="color: #558b2f; font-weight: 600;">Transaction ID:</span>
                <span style="color: #2e7d32; font-weight: 500; font-family: monospace;">{{ $transaction->id }}</span>
            </div>
        </div>
    </div>

    <!-- Next Steps -->
    <div style="background: white; padding: 28px; border-radius: 12px; margin-bottom: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border-left: 4px solid #2196f3;">
        <h2 style="color: #1565c0; font-size: 20px; margin: 0 0 25px 0; font-weight: 600; display: flex; align-items: center;">
            <span style="background: #2196f3; width: 8px; height: 8px; border-radius: 50%; margin-right: 15px; box-shadow: 0 0 8px rgba(33, 150, 243, 0.4);"></span>
            What happens next?
        </h2>
        <div style="background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%); padding: 20px; border-radius: 8px; border: 2px solid #bbdefb;">
            <div style="display: flex; align-items: center; margin-bottom: 15px;">
                <span style="font-size: 24px; margin-right: 12px;">⏰</span>
                <span style="color: #1565c0; font-size: 16px; font-weight: 600;">Processing Time</span>
            </div>
            <p style="color: #1976d2; font-size: 16px; margin: 0; line-height: 1.6;">
                Your topup will be processed within <strong style="color: #1565c0;">1x24 hours</strong>. You will receive another notification once the items have been added to your account.
            </p>
        </div>
    </div>

    <!-- Support Section -->
    <div style="background: white; padding: 28px; border-radius: 12px; margin-bottom: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); border-left: 4px solid #ff9800;">
        <h2 style="color: #e65100; font-size: 20px; margin: 0 0 25px 0; font-weight: 600; display: flex; align-items: center;">
            <span style="background: #ff9800; width: 8px; height: 8px; border-radius: 50%; margin-right: 15px; box-shadow: 0 0 8px rgba(255, 152, 0, 0.4);"></span>
            Need help?
        </h2>
        <div style="background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%); padding: 20px; border-radius: 8px; border: 2px solid #ffcc80;">
            <div style="display: flex; align-items: center; margin-bottom: 15px;">
                <span style="font-size: 24px; margin-right: 12px;">💬</span>
                <span style="color: #e65100; font-size: 16px; font-weight: 600;">24/7 Support</span>
            </div>
            <p style="color: #f57c00; font-size: 16px; margin: 0; line-height: 1.6;">
                If you have any questions, please contact our support team in discord. We're here to help!
            </p>
        </div>
    </div>

    <!-- Thank You and Footer -->
    <div style="text-align: center; padding: 30px; background: linear-gradient(135deg, #4caf50 0%, #66bb6a 100%); border-radius: 16px; box-shadow: 0 8px 25px rgba(76, 175, 80, 0.3); color: white;">
        <div style="font-size: 36px; margin-bottom: 15px;">🎉</div>
        <p style="color: #e8f5e8; font-size: 18px; margin: 0 0 20px 0; line-height: 1.6; font-weight: 500;">
            Thank you for choosing our service!
        </p>
        <div style="color: white; font-size: 17px; margin-bottom: 8px; font-weight: 600;">
            Best regards, <strong>Ranconnity</strong>
        </div>
        <div style="color: #e8f5e8; font-size: 15px;">{{ config('app.name') }}</div>
    </div>

    <!-- Disclaimer -->
    <div style="text-align: center; margin-top: 30px; padding: 18px; background: rgba(76, 175, 80, 0.1); border-radius: 8px; border: 1px solid rgba(76, 175, 80, 0.2);">
        <p style="color: #558b2f; font-size: 13px; margin: 0; opacity: 0.8; font-style: italic;">
            This is an automated message. Please do not reply to this email.
        </p>
    </div>
</div>
@endcomponent 