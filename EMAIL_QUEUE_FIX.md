# Email Queue Fix - Solving 500 Error & Timeout Issues

## Problem Diagnosed

### Symptoms
1. **Loading terlalu lama** (1 minute+) pada `/booking/{product}/finish` setelah payment
2. **500 Server Error** pada `/contact/send` 
3. **Tiket tidak terkirim** via email setelah payment settlement
4. **Pesan contact tidak terkirim** ke admin email

### Root Cause
Railway logs menunjukkan:
```
PHP Fatal error: Maximum execution time of 30 seconds exceeded 
in /app/vendor/symfony/mailer/Transport/Smtp/Stream/SocketStream.php on line 154

2026-01-14 04:01:20 /booking/pengempu-waterfall/finish ~ 1m 1s
2026-01-14 04:03:25 /contact/send ~ 1m
```

**Masalah**: Email dikirim **synchronously** menggunakan `Mail::send()`. Ketika SMTP Gmail lambat/timeout, request HTTP menunggu 30 detik → Fatal Error → User tidak dapat response → Email gagal terkirim.

## Solution Implemented

### 1. Changed Email Sending to Async Queue

**Before (Blocking)**:
```php
// MidtransController.php & KontakController.php
Mail::to($email)->send(new MailClass($data));
// ❌ Blocks HTTP response until email sent (30s timeout risk)
```

**After (Non-blocking)**:
```php
// Queue email for background processing
Mail::to($email)->queue(new MailClass($data));
// ✅ Immediate response, email sent by worker in background
```

### 2. Files Modified

#### `app/Http/Controllers/MidtransController.php`
```php
// Line 44-48: Changed send() to queue()
Mail::to($order->email)->queue(
    new TicketMail($order, $ticket)
);
Log::info('Ticket email queued for: ' . $order->email);
```

#### `app/Http/Controllers/KontakController.php`
```php
// Line 29-31: Changed send() to queue()
Mail::to('pengempuw@gmail.com')
    ->queue(new SendMail($data));
```

### 3. Queue Worker Setup

#### Created `start.sh` (Railway startup script)
```bash
#!/bin/bash

# Clear caches
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Start queue worker in background
php artisan queue:work --daemon --tries=3 --timeout=90 &

# Start web server in foreground
php artisan serve --host=0.0.0.0 --port=$PORT
```

**Explanation**:
- `queue:work --daemon`: Run queue worker continuously
- `--tries=3`: Retry failed jobs 3 times
- `--timeout=90`: Allow 90s for each job (enough for slow SMTP)
- `&`: Run in background
- Web server runs in foreground (required for Railway)

#### Updated `nixpacks.toml`
```toml
[start]
cmd = "bash start.sh"
```

### 4. Queue Configuration

Already configured in `config/queue.php`:
```php
'default' => env('QUEUE_CONNECTION', 'database'),
```

Uses `database` driver (stores jobs in `jobs` table from migration `0001_01_01_000002_create_jobs_table.php`).

## How It Works Now

### Payment Flow (Fixed)
```
User completes payment
    ↓
Midtrans sends webhook to /midtrans/handle
    ↓
MidtransController:
  1. Update order status to 'settlement'
  2. Create ticket with QR code
  3. Queue email (returns immediately) ✅
    ↓
HTTP responds "OK" (< 1 second)
    ↓
Queue worker picks up job in background
    ↓
Email sent via SMTP (30-60s, doesn't block user)
```

### Contact Form Flow (Fixed)
```
User submits contact form
    ↓
KontakController:
  1. Validate data
  2. Queue email to pengempuw@gmail.com ✅
  3. Return success message immediately
    ↓
User sees "Pesan berhasil dikirim" (instant)
    ↓
Queue worker sends email in background
```

## Benefits

| Before (Synchronous) | After (Queue) |
|---------------------|---------------|
| ❌ 30-60s waiting time | ✅ < 1s response |
| ❌ Timeout errors (500) | ✅ No timeouts |
| ❌ Email fails → user stuck | ✅ Email retries automatically |
| ❌ Poor UX | ✅ Instant feedback |

## Testing After Deploy

### Test 1: Contact Form Email
1. Go to: https://pengempu-waterfall-production.up.railway.app/contact
2. Fill form and submit
3. **Expected**: Instant redirect with success message
4. **Check**: Railway logs for `Queued mail` entry
5. **Verify**: Email arrives at pengempuw@gmail.com within 1-2 minutes

### Test 2: Ticket Email After Payment
1. Complete booking flow
2. Pay via Midtrans (use test card: 4811 1111 1111 1114)
3. **Expected**: Redirect to finish page immediately
4. **Check**: Railway logs for `Ticket email queued`
5. **Verify**: Ticket email with QR arrives at customer email

### Test 3: Check Queue Status
```bash
# See failed jobs (should be empty)
railway run php artisan queue:failed

# Clear failed jobs if any
railway run php artisan queue:flush
```

## Railway Environment Variables

Required variables (already set):
```env
QUEUE_CONNECTION=database
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=pengempuw@gmail.com
MAIL_PASSWORD=***** (App Password)
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=pengempuw@gmail.com
MAIL_FROM_NAME="Pengempu Waterfall"
```

## Monitoring Queue Health

### Check if queue worker is running:
```bash
railway logs --filter="queue:work"
```

Should see:
```
Processing: App\Mail\TicketMail
Processed:  App\Mail\TicketMail
```

### If queue worker crashes:
Railway will auto-restart the container (start.sh runs again).

### Manual queue processing (if needed):
```bash
# Process all pending jobs once
railway run php artisan queue:work --once

# Process specific number of jobs
railway run php artisan queue:work --max-jobs=10
```

## Rollback Plan (If Issues Occur)

If queue doesn't work in production:

1. **Quick fix**: Change back to `Mail::send()` temporarily
2. **Check**: Railway environment variables for MAIL_* config
3. **Alternative**: Use `QUEUE_CONNECTION=sync` (processes immediately but still in queue system)

## Additional Notes

- Queue uses `database` driver → Jobs stored in `jobs` table
- Failed jobs stored in `failed_jobs` table (check with `php artisan queue:failed`)
- Queue worker restarts automatically if container restarts
- No Redis/external queue service needed (simple deployment)

## Commit Hash
```
12025b1c - fix: implement async queue for email sending to prevent timeout
```

## Related Files
- `app/Http/Controllers/MidtransController.php`
- `app/Http/Controllers/KontakController.php`
- `start.sh` (new)
- `nixpacks.toml`
- `config/queue.php`
