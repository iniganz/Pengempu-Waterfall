# RESEND EMAIL ISSUE - ROOT CAUSE & SOLUTIONS

## 🚨 ROOT CAUSE FOUND

**Error Message:**
```
You can only send testing emails to your own email address (pengempuw@gmail.com). 
To send emails to other recipients, please verify a domain at resend.com/domains, 
and change the `from` address to an email using this domain.
```

**Problem:**
Resend **FREE account** has strict limitations:
- ✅ Can send TO: Your verified email only (`pengempuw@gmail.com`)
- ✅ Can send FROM: `onboarding@resend.dev` (Resend default domain)
- ❌ CANNOT send TO: Customer emails (random addresses)
- ❌ CANNOT send FROM: Your own domain (until verified)

**Why Contact Form Works but Ticket Doesn't:**
- Contact form sends TO: `pengempuw@gmail.com` ✅ (your verified email)
- Ticket email sends TO: `gandhigunadi7@gmail.com` ❌ (customer email, not verified)

---

## ✅ TEMPORARY FIX APPLIED

**File Changes:**
- `app/Http/Controllers/Admin/OrderAdminController.php`
- `app/Http/Controllers/BookingController.php`
- `app/Http/Controllers/MidtransController.php`

**What Changed:**
```php
// BEFORE (BROKEN):
ResendMailer::send(
    from: 'Admin <onboarding@resend.dev>',
    to: $order->email,  // ← Customer email (fails on Resend free tier)
    subject: 'Tiket Resmi - ' . $order->order_id,
    html: $html
);

// AFTER (TEMPORARY FIX):
$recipientEmail = env('APP_ENV') === 'production' ? 'pengempuw@gmail.com' : $order->email;

ResendMailer::send(
    from: 'Admin <onboarding@resend.dev>',
    to: $recipientEmail,  // ← Always your email in production
    subject: 'Tiket Resmi - ' . $order->order_id . ' (untuk: ' . $order->email . ')',  // ← Shows real recipient in subject
    html: $html
);
```

**Effect:**
- ✅ All ticket emails now go to `pengempuw@gmail.com` (for testing/monitoring)
- ✅ Subject line shows who the ticket was for: `(untuk: gandhigunadi7@gmail.com)`
- ✅ You can forward tickets manually to customers
- ❌ Customers don't receive automatic emails (not production-ready!)

---

## 🎯 PERMANENT SOLUTIONS

### **Option 1: Verify Custom Domain (RECOMMENDED for Production)**

**Steps:**
1. **Login to Resend:** https://resend.com/domains
2. **Add Your Domain:** e.g., `pengempuwaterfall.com`
3. **Add DNS Records:** 
   - Resend will give you DNS records (SPF, DKIM, DMARC)
   - Add them to your domain registrar (Cloudflare, GoDaddy, etc.)
4. **Wait for Verification:** Usually 5-30 minutes
5. **Update Code:**
   ```php
   // Change FROM address to use verified domain
   ResendMailer::send(
       from: 'Pengempu Waterfall <noreply@pengempuwaterfall.com>',  // ← Your verified domain
       to: $order->email,  // ← Can now send to ANY email
       subject: 'Tiket Resmi - ' . $order->order_id,
       html: $html
   );
   ```
6. **Update Railway Variables:**
   ```bash
   railway variables --set MAIL_FROM_ADDRESS=noreply@pengempuwaterfall.com
   ```
7. **Remove Temporary Fix:**
   ```php
   // Delete this line:
   $recipientEmail = env('APP_ENV') === 'production' ? 'pengempuw@gmail.com' : $order->email;
   
   // Use original:
   to: $order->email,
   ```

**Benefits:**
- ✅ Send to unlimited recipients
- ✅ Professional email address (`noreply@yourdomain.com`)
- ✅ Better deliverability (SPF/DKIM configured)
- ✅ No rate limits (10,000 emails/month free)

---

### **Option 2: Upgrade Resend Plan**

**If you don't have a custom domain yet:**
1. **Upgrade to Resend Pro:** $20/month
   - Removes recipient validation requirement
   - 50,000 emails/month
   - Can still use `onboarding@resend.dev`
2. **Update Code:** Remove temporary fix (send to `$order->email` directly)

**Not recommended** - costs $20/month and still uses Resend's domain.

---

### **Option 3: Switch Back to Gmail SMTP (NOT RECOMMENDED)**

**Why NOT recommended:**
- ❌ 30-60 second timeout issues on Railway
- ❌ Gmail blocks/limits sending
- ❌ Poor user experience (page hangs)

**Only use if:**
- You can't verify a domain
- You can't upgrade Resend
- You accept slow email sending

---

## 📋 RECOMMENDED ACTION PLAN

### **For Testing/Development (NOW):**
✅ **Current setup works!**
- All ticket emails go to `pengempuw@gmail.com`
- You can test full booking flow
- Monitor all ticket emails in one inbox

### **For Production (BEFORE LAUNCH):**
1. **Get a Domain:** Buy domain or use existing (e.g., `pengempuwaterfall.com`)
2. **Verify in Resend:** https://resend.com/domains → Add domain → Configure DNS
3. **Update Code:**
   - Change `MAIL_FROM_ADDRESS` to `noreply@yourdomain.com`
   - Remove recipient override (`$recipientEmail` logic)
   - Deploy to Railway
4. **Test:** Book ticket with real customer email → Should receive email

**Estimated Time:** 30 minutes to verify domain + 5 minutes to update code

---

## 🔍 HOW TO VERIFY DOMAIN IN RESEND

### **Step-by-Step:**

1. **Login:** https://resend.com/login
2. **Go to Domains:** Click "Domains" in sidebar
3. **Add Domain:** Click "+ Add Domain"
4. **Enter Domain:** Type `pengempuwaterfall.com` (your domain)
5. **Copy DNS Records:** Resend shows 3 records:
   ```
   TXT  _resend    value: resend-verify-abc123xyz
   TXT  @          value: v=spf1 include:_spf.resend.dev ~all
   CNAME resend._domainkey  value: resend._domainkey.resend.dev
   ```
6. **Add to DNS Provider:**
   - If Cloudflare: DNS → Add Record → Paste values
   - If GoDaddy: DNS Management → Add TXT/CNAME → Paste values
   - If Namecheap: Advanced DNS → Add Record → Paste values
7. **Verify:** Click "Verify Domain" in Resend (wait 5-30 min for propagation)
8. **Status:** Shows "✅ Verified" when done

### **No Domain? Quick Options:**
- **Buy Cheap Domain:** Namecheap (~$10/year for `.com`)
- **Free Subdomain:** Use Cloudflare Pages (`yourapp.pages.dev`) - but email won't work
- **Use Existing:** If you have any website/blog, use that domain

---

## 📊 CURRENT STATUS

- ✅ **Issue Identified:** Resend free account recipient limitation
- ✅ **Temporary Fix:** Deployed (send to `pengempuw@gmail.com`)
- ✅ **Logging:** Enhanced (can see full error messages now)
- ⏳ **Production Ready:** NO - need verified domain first
- ⏳ **Next Step:** Verify custom domain in Resend

---

## 🎉 SUCCESS METRICS

After deploying temporary fix:
- ✅ Resend button works (no errors)
- ✅ Email appears in `pengempuw@gmail.com` inbox
- ✅ Subject shows real recipient: `(untuk: customer@email.com)`
- ✅ Can test full booking flow end-to-end
- ✅ Can manually forward tickets to customers if needed

---

## 📌 FILES TO REVERT AFTER DOMAIN VERIFICATION

Search for this comment in code:
```php
// TEMPORARY FIX: Resend free account only sends to pengempuw@gmail.com
```

**Files to update:**
1. `app/Http/Controllers/Admin/OrderAdminController.php` (line ~103)
2. `app/Http/Controllers/BookingController.php` (line ~312)
3. `app/Http/Controllers/MidtransController.php` (line ~69)

**Change:**
```php
// DELETE:
$recipientEmail = env('APP_ENV') === 'production' ? 'pengempuw@gmail.com' : $order->email;

// CHANGE:
to: $recipientEmail,              // ← OLD
to: (string) $order->email,       // ← NEW

// CHANGE:
subject: '... (untuk: ' . $order->email . ')',  // ← OLD
subject: 'Tiket Resmi - ' . $order->order_id,   // ← NEW
```

---

**Last Updated:** 2026-01-14  
**Status:** Temporary fix deployed, awaiting domain verification
