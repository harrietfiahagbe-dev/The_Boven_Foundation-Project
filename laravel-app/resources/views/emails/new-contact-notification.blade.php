<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
</head>
<body style="font-family: 'Plus Jakarta Sans', Arial, sans-serif; line-height: 1.6; color: #1a1f1a; background-color: #f8faf8; margin: 0; padding: 0;">
    <table role="presentation" style="width: 100%; border-collapse: collapse; background-color: #f8faf8;">
        <tr>
            <td style="padding: 40px 20px;">
                <table role="presentation" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);">
                    <tr>
                        <td style="background: linear-gradient(135deg, #0d5c1a 0%, #1b7d2e 100%); padding: 32px 24px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 22px; font-weight: 700; font-family: 'Outfit', Arial, sans-serif;">
                                New Contact Message
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 32px 24px;">
                            <p style="margin: 0 0 16px; font-size: 15px; color: #1a1f1a;">
                                Someone has submitted the contact form on <strong>The Boven Foundation</strong> website.
                            </p>

                            <h2 style="margin: 24px 0 12px; font-size: 16px; color: #0d5c1a; font-family: 'Outfit', Arial, sans-serif;">Details</h2>

                            <table role="presentation" style="width: 100%; border-collapse: collapse; font-size: 14px;">
                                <tr>
                                    <td style="padding: 6px 0; color: #4a5d4a;">Name:</td>
                                    <td style="padding: 6px 0; text-align: right; color: #1a1f1a; font-weight: 600;">{{ $contact->name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 6px 0; color: #4a5d4a;">Email:</td>
                                    <td style="padding: 6px 0; text-align: right; color: #1a1f1a; font-weight: 600;">{{ $contact->email }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 6px 0; color: #4a5d4a;">Subject:</td>
                                    <td style="padding: 6px 0; text-align: right; color: #1a1f1a; font-weight: 600;">{{ $contact->subject }}</td>
                                </tr>
                            </table>

                            <h2 style="margin: 24px 0 12px; font-size: 16px; color: #0d5c1a; font-family: 'Outfit', Arial, sans-serif;">Message</h2>

                            <p style="margin: 0; font-size: 14px; color: #1a1f1a; white-space: pre-line;">{{ $contact->message }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #f8faf8; padding: 20px 24px; text-align: center; border-top: 1px solid #e8ede8; font-size: 12px; color: #4a5d4a;">
                            This email was sent automatically from thebovenfoundation.org contact form.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
