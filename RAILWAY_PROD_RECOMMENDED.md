# Railway Production Recommended Setup

This project runs fine locally with Gmail SMTP, but on Railway the direct SMTP connection to `smtp.gmail.com` can time out (socket hang), causing slow requests or fatal errors.

To keep the web fast and reliable in production, use:

1) **Resend (email via HTTPS API)** – avoids SMTP socket issues.
2) **Cloudinary (image uploads)** – avoids Railway ephemeral filesystem.

## ✅ Email (recommended): Resend

### Railway variables

Set these in Railway:

- `MAIL_MAILER=resend`
- `RESEND_API_KEY=YOUR_KEY`
- `MAIL_FROM_ADDRESS=onboarding@resend.dev` (or your verified domain sender)
- `MAIL_FROM_NAME=Admin Waterfall Pengempu`

Notes:

- If `RESEND_API_KEY` is set, code will automatically use Resend.
- If Resend isn't configured yet, the app can fall back to `MAIL_MAILER=log` to avoid slow failures.

## ✅ Images (recommended): Cloudinary

Railway disk is ephemeral – uploads can disappear after redeploy/restart.

Follow `CLOUDINARY_SETUP.md` / `IMAGE_STORAGE_FIX.md`.

## Storage symlink

This app serves uploaded files at `/storage/...` which requires:

- `php artisan storage:link`

It's now executed on every boot (`start.sh`).
