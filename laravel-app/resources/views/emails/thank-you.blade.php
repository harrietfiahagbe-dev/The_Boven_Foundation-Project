<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Your Donation</title>
</head>
<body style="font-family: 'Plus Jakarta Sans', Arial, sans-serif; line-height: 1.6; color: #1a1f1a; background-color: #f8faf8; margin: 0; padding: 0;">
    <table role="presentation" style="width: 100%; border-collapse: collapse; background-color: #f8faf8;">
        <tr>
            <td style="padding: 40px 20px;">
                <table role="presentation" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #0d5c1a 0%, #1b7d2e 100%); padding: 40px 30px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 28px; font-weight: 700; font-family: 'Outfit', Arial, sans-serif;">
                                Thank You, {{ $donorName }}!
                            </h1>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 30px;">
                            <p style="margin: 0 0 20px; font-size: 16px; color: #1a1f1a;">
                                We are incredibly grateful for your generous donation of <strong style="color: #0d5c1a;">GHS {{ $amount }}</strong> to The Boven Foundation.
                            </p>
                            
                            <p style="margin: 0 0 20px; font-size: 16px; color: #1a1f1a;">
                                Your contribution helps us provide STEM education to underserved youth in Ghana, empowering the next generation of innovators and problem-solvers.
                            </p>
                            
                            <!-- Donation Details -->
                            <div style="background-color: #f8faf8; border-left: 4px solid #0d5c1a; padding: 20px; margin: 30px 0; border-radius: 8px;">
                                <h2 style="margin: 0 0 15px; font-size: 18px; color: #0d5c1a; font-family: 'Outfit', Arial, sans-serif;">
                                    Donation Details
                                </h2>
                                <table role="presentation" style="width: 100%; border-collapse: collapse;">
                                    <tr>
                                        <td style="padding: 8px 0; color: #4a5d4a; font-size: 14px;">Amount:</td>
                                        <td style="padding: 8px 0; text-align: right; font-weight: 600; color: #1a1f1a; font-size: 14px;">GHS {{ $amount }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0; color: #4a5d4a; font-size: 14px;">Payment Method:</td>
                                        <td style="padding: 8px 0; text-align: right; font-weight: 600; color: #1a1f1a; font-size: 14px;">{{ $paymentMethod }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0; color: #4a5d4a; font-size: 14px;">Date:</td>
                                        <td style="padding: 8px 0; text-align: right; font-weight: 600; color: #1a1f1a; font-size: 14px;">{{ $donation->payment_date->format('F j, Y') }}</td>
                                    </tr>
                                </table>
                            </div>
                            
                            <p style="margin: 20px 0 0; font-size: 16px; color: #1a1f1a;">
                                Your support makes a real difference in the lives of young people across Ghana. Together, we're building a brighter future through education.
                            </p>
                            
                            <p style="margin: 30px 0 0; font-size: 16px; color: #1a1f1a;">
                                With gratitude,<br>
                                <strong style="color: #0d5c1a;">The Boven Foundation Team</strong>
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8faf8; padding: 30px; text-align: center; border-top: 1px solid #e8ede8;">
                            <p style="margin: 0 0 10px; font-size: 14px; color: #4a5d4a;">
                                The Boven Foundation<br>
                                Empowering Communities Through Education and Action
                            </p>
                            <p style="margin: 0; font-size: 12px; color: #4a5d4a;">
                                Email: <a href="mailto:thebovenfoundation@gmail.com" style="color: #0d5c1a; text-decoration: none;">thebovenfoundation@gmail.com</a>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
