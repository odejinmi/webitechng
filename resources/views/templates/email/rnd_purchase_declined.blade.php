<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RND Purchase Declined</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <div style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
            <h1 style="margin: 0; font-size: 28px;">RND Purchase Declined</h1>
        </div>
        
        <div style="background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px; border: 1px solid #e0e0e0; border-top: none;">
            <p style="font-size: 16px;">Dear {{ $user->fullname }},</p>
            
            <p style="font-size: 16px;">We regret to inform you that your RND token purchase request has been declined.</p>
            
            <div style="background: white; padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #dc3545;">
                <h3 style="margin: 0 0 15px 0; color: #dc3545;">Purchase Details</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold; width: 150px;">Request ID:</td>
                        <td style="padding: 8px 0;">#{{ $purchase->id }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold;">RND Amount:</td>
                        <td style="padding: 8px 0;">{{ number_format($purchase->rnd_amount, 8) }} RND</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; font-weight: bold;">Total Amount:</td>
                        <td style="padding: 8px 0;">{{ number_format($purchase->total_amount, 8) }}</td>
                    </tr>
                </table>
            </div>
            
            @if($purchase->admin_note)
            <div style="background: #fff3cd; padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #ffc107;">
                <h3 style="margin: 0 0 10px 0; color: #856404;">Reason for Decline</h3>
                <p style="margin: 0;">{{ $purchase->admin_note }}</p>
            </div>
            @endif
            
            <div style="background: #d4edda; padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #28a745;">
                <h3 style="margin: 0 0 10px 0; color: #155724;">Refund Processed</h3>
                <p style="margin: 0;">The full amount of {{ number_format($purchase->total_amount, 8) }} has been refunded to your wallet balance.</p>
            </div>
            
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ route('user.rnd.purchases.show', $purchase) }}" style="background: #dc3545; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">View Purchase Details</a>
            </div>
            
            <p style="font-size: 14px; color: #666; margin-top: 30px;">If you have any questions about this decision, please contact our support team.</p>
            
            <hr style="border: none; border-top: 1px solid #e0e0e0; margin: 30px 0;">
            
            <p style="font-size: 12px; color: #999; text-align: center;">
                This is an automated message. Please do not reply to this email.
            </p>
        </div>
    </div>
</body>
</html>
