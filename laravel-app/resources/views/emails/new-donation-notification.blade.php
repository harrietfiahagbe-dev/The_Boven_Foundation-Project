<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Donation Received</title>
</head>
<body style="font-family: 'Plus Jakarta Sans', Arial, sans-serif; line-height: 1.6; color: #1a1f1a; background-color: #f8faf8; margin: 0; padding: 0;">
    <table role="presentation" style="width: 100%; border-collapse: collapse; background-color: #f8faf8;">
        <tr>
            <td style="padding: 40px 20px;">
                <table role="presentation" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);">
                    <tr>
                        <td style="background: linear-gradient(135deg, #0d5c1a 0%, #1b7d2e 100%); padding: 32px 24px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 22px; font-weight: 700; font-family: 'Outfit', Arial, sans-serif;">
                                New Donation Received
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 32px 24px;">
                            <p style="margin: 0 0 16px; font-size: 15px; color: #1a1f1a;">
                                A new donation has been submitted on <strong>The Boven Foundation</strong> website.
                            </p>

                            <h2 style="margin: 24px 0 12px; font-size: 16px; color: #0d5c1a; font-family: 'Outfit', Arial, sans-serif;">Donation Details</h2>

                            <table role="presentation" style="width: 100%; border-collapse: collapse; font-size: 14px;">
                                <tr>
                                    <td style="padding: 6px 0; color: #4a5d4a;">Donor:</td>
                                    <td style="padding: 6px 0; text-align: right; color: #1a1f1a; font-weight: 600;">{{ $donation->name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 6px 0; color: #4a5d4a;">Phone:</td>
                                    <td style="padding: 6px 0; text-align: right; color: #1a1f1a; font-weight: 600;">{{ $donation->phone }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 6px 0; color: #4a5d4a;">Email:</td>
                                    <td style="padding: 6px 0; text-align: right; color: #1a1f1a; font-weight: 600;">{{ $donation->email ?: '—' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 6px 0; color: #4a5d4a;">Amount:</td>
                                    <td style="padding: 6px 0; text-align: right; color: #1a1f1a; font-weight: 600;">GHS {{ number_format($donation->amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 6px 0; color: #4a5d4a;">Payment Method:</td>
                                    <td style="padding: 6px 0; text-align: right; color: #1a1f1a; font-weight: 600;">{{ ucfirst(str_replace('_', ' ', $donation->payment_method)) }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 6px 0; color: #4a5d4a;">Payment Date:</td>
                                    <td style="padding: 6px 0; text-align: right; color: #1a1f1a; font-weight: 600;">{{ optional($donation->payment_date)->format('F j, Y') }}</td>
                                </tr>
                                @if ($donation->transaction_reference)
                                <tr>
                                    <td style="padding: 6px 0; color: #4a5d4a;">Reference:</td>
                                    <td style="padding: 6px 0; text-align: right; color: #1a1f1a; font-weight: 600;">{{ $donation->transaction_reference }}</td>
                                </tr>
                                @endif
                            </table>

                            @if ($donation->notes)
                                <h2 style="margin: 24px 0 12px; font-size: 16px; color: #0d5c1a; font-family: 'Outfit', Arial, sans-serif;">Notes</h2>
                                <p style="margin: 0; font-size: 14px; color: #1a1f1a; white-space: pre-line;">{{ $donation->notes }}</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #f8faf8; padding: 20px 24px; text-align: center; border-top: 1px solid #e8ede8; font-size: 12px; color: #4a5d4a;">
                            This email was sent automatically from thebovenfoundation.org donation confirmation form.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
