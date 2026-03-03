# Email Configuration Guide for The Boven Foundation

## What is Email Configuration?

Email configuration tells Laravel **how to send emails**. When someone fills out the donation form, Laravel needs to know:
- Which email service to use (Gmail, SMTP server, etc.)
- What email address to send FROM
- What credentials to use

---

## Option 1: Log Mode (Current - For Testing) ✅ EASIEST

**What it does:** Emails are saved to a log file instead of being sent. Perfect for testing!

**Current setting in your `.env`:**
```env
MAIL_MAILER=log
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

**How to check if emails are being "sent":**
- Emails are saved in: `storage/logs/laravel.log`
- Open the log file and search for "Thank You for Your Donation"

**✅ Pros:** No setup needed, works immediately
**❌ Cons:** Donors don't actually receive emails

---

## Option 2: Gmail SMTP (Recommended for Production) 📧

**What it does:** Uses your Gmail account to send real emails to donors.

When Gmail SMTP is correctly configured:

- Donors receive a **thank-you email** after submitting the donation form.
- The foundation receives:
  - A **contact notification email** whenever someone submits the contact form.
  - A **donation notification email** whenever a new donation is recorded.

### Step-by-Step Setup:

#### Step 1: Enable Gmail App Password

1. Go to your Google Account: https://myaccount.google.com/
2. Click **Security** (left sidebar)
3. Under "Signing in to Google", enable **2-Step Verification** (if not already enabled)
4. After enabling 2-Step Verification, go back to Security
5. Click **App passwords** (you may need to search for it)
6. Select **Mail** and **Other (Custom name)**
7. Type "Laravel Donation System" as the name
8. Click **Generate**
9. **Copy the 16-character password** (you'll need this!)

#### Step 2: Update Your `.env` File

Open `/laravel-app/.env` and change these lines:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=thebovenfoundation@gmail.com
MAIL_PASSWORD=your-16-character-app-password-here
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="thebovenfoundation@gmail.com"
MAIL_FROM_NAME="The Boven Foundation"
# Optional: override where internal notifications are sent
# If set, contact and donation notification emails go here
MAIL_NOTIFY_TO="thebovenfoundation@gmail.com"
```

**Replace:**
- `your-16-character-app-password-here` with the password from Step 1

#### Step 3: Test It!

1. Fill out the donation form on your website
2. Provide an email address
3. Check if the thank-you email arrives!

---

## Option 3: Other Email Services

### Using Mailtrap (For Development/Testing)

**What it does:** Catches emails in a test inbox (great for development)

1. Sign up at https://mailtrap.io (free)
2. Get your SMTP credentials from Mailtrap
3. Update `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="thebovenfoundation@gmail.com"
MAIL_FROM_NAME="The Boven Foundation"
```

### Using SendGrid, Mailgun, or Other Services

Similar process - get SMTP credentials from your email service provider and update the `.env` file.

---

## Quick Reference: What Each Setting Means

| Setting | What It Does | Example |
|---------|-------------|---------|
| `MAIL_MAILER` | Which email method to use | `log`, `smtp`, `sendmail` |
| `MAIL_HOST` | Email server address | `smtp.gmail.com` |
| `MAIL_PORT` | Port number for email server | `587` (Gmail) |
| `MAIL_USERNAME` | Your email address | `thebovenfoundation@gmail.com` |
| `MAIL_PASSWORD` | Your email password/app password | `abcd efgh ijkl mnop` |
| `MAIL_ENCRYPTION` | Security encryption type | `tls` or `ssl` |
| `MAIL_FROM_ADDRESS` | Email address shown as sender | `thebovenfoundation@gmail.com` |
| `MAIL_FROM_NAME` | Name shown as sender | `The Boven Foundation` |
| `MAIL_NOTIFY_TO` | (Optional) Where admin/contact/donation notifications go | `thebovenfoundation@gmail.com` |

---

## Troubleshooting

### Emails Not Sending?

1. **Check `.env` file** - Make sure values are correct (no extra spaces!)
2. **Clear config cache:** Run `php artisan config:clear`
3. **Check logs:** Look in `storage/logs/laravel.log` for errors
4. **Test connection:** Try sending a test email

### Gmail Not Working?

- Make sure you enabled **App Password** (not your regular Gmail password)
- Check that **2-Step Verification** is enabled
- Verify port is `587` and encryption is `tls`

---

## Current Recommendation

**For now (testing):** Keep `MAIL_MAILER=log` - it works immediately!

**When ready for production:** Switch to Gmail SMTP (Option 2) so donors actually receive thank-you emails.

---

## Need Help?

If you're stuck, check:
- Laravel logs: `storage/logs/laravel.log`
- Email errors will be logged there
- The donation will still be saved even if email fails!
