<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RMB Purchase Approved</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
            <h1 style="margin: 0; font-size: 28px;">RMB Purchase Approved! 🎉</h1>
        </div>

        <div style="background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px; border: 1px solid #e0e0e0; border-top: none;">
            <p style="font-size: 16px;">Dear {{ $user->fullname }},</p>

            <p style="font-size: 16px;">Great news! Your RMB token purchase request has been approved.</p>

            <div style="background: white; padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #28a745;">
                <h3 style="margin: 0 0 15px 0; color: #28a745;">Purchase Details</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold; width: 150px;">Request ID:</td>
                        <td style="padding: 8px 0;">#{{ $purchase->id }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold;">RMB Amount:</td>
                        <td style="padding: 8px 0;">{{ number_format($purchase->rnd_amount, 8) }} RMB</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold;">Exchange Rate:</td>
                        <td style="padding: 8px 0;">{{ number_format($purchase->exchange_rate, 2) }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold;">Total Amount:</td>
                        <td style="padding: 8px 0;">{{ number_format($purchase->total_amount, 8) }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold;">Vendor:</td>
                        <td style="padding: 8px 0;">{{ $purchase->vendor_name }}</td>
                    </tr>
                </table>
            </div>

            <div style="background: #e8f5e8; padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #28a745;">
                <h3 style="margin: 0 0 10px 0; color: #28a745;">Receipt Available</h3>
                <p style="margin: 0;">Your purchase receipt is now available in your dashboard. You can download it for your records.</p>
            </div>

            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ route('user.rnd.purchases.show', $purchase) }}" style="background: #28a745; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">View Purchase Details</a>
            </div>

            <p style="font-size: 14px; color: #666; margin-top: 30px;">Thank you for using our RMB token purchase service!</p>

            <hr style="border: none; border-top: 1px solid #e0e0e0; margin: 30px 0;">

            <p style="font-size: 12px; color: #999; text-align: center;">
                This is an automated message. Please do not reply to this email.
            </p>
        </div>
    </div>
</body>
</html>
