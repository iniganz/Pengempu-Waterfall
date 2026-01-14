# SETUP CUSTOM DOMAIN - tiket.pengempuw.com

## 📋 CHECKLIST

- [ ] Add DNS records ke domain provider
- [ ] Wait for DNS propagation (5-30 min)
- [ ] Verify domain di Resend dashboard
- [ ] Update Railway MAIL_FROM_ADDRESS
- [ ] Remove recipient override di code
- [ ] Test email sending
- [ ] Deploy to production

---

## 🚀 STEP-BY-STEP GUIDE

### **Step 1: Get DNS Records from Resend**

From your Resend dashboard screenshot, you need to add these DNS records:

**SPF Record (REQUIRED):**
```
Type: TXT
Name: send.tiket
Content: v=spf1 include:amazons...
TTL: Auto
```

**MX Record (REQUIRED):**
```
Type: MX
Name: send.tiket  
Content: feedback-smtp.ap-northeast-1.amazonses.com
Priority: 10
TTL: Auto
```

**DMARC Record (OPTIONAL but RECOMMENDED):**
```
Type: TXT
Name: _dmarc
Content: v=DMARC1; p=none;
TTL: Auto
```

---

### **Step 2: Add Records to Your DNS Provider**

**Where do you manage `pengempuw.com` DNS?**

#### **Option A: Cloudflare**
1. Login: https://dash.cloudflare.com
2. Select domain: `pengempuw.com`
3. Go to **DNS** tab
4. Click **Add record**
5. Add each record from Step 1:
   - Type: `TXT`
   - Name: `send.tiket` (will become `send.tiket.pengempuw.com`)
   - Content: `v=spf1 include:amazons...`
   - Click **Save**
6. Repeat for MX record:
   - Type: `MX`
   - Name: `send.tiket`
   - Mail server: `feedback-smtp.ap-northeast-1.amazonses.com`
   - Priority: `10`
   - Click **Save**
7. Add DMARC:
   - Type: `TXT`
   - Name: `_dmarc`
   - Content: `v=DMARC1; p=none;`
   - Click **Save**

#### **Option B: GoDaddy**
1. Login: https://dcc.godaddy.com
2. My Products → Domain → DNS
3. Click **Add** → Choose **TXT**
4. Host: `send.tiket`
5. TXT Value: `v=spf1 include:amazons...`
6. Save
7. Repeat for MX and DMARC

#### **Option C: Niagahoster / Rumahweb (Indonesia)**
1. Login ke client area
2. Layanan Saya → Domain → Kelola DNS
3. Tambah Record:
   - Tipe: `TXT`
   - Host: `send.tiket`
   - Value: `v=spf1 include:amazons...`
4. Simpan
5. Ulangi untuk MX dan DMARC

---

### **Step 3: Verify DNS Propagation**

**Check if DNS records are live:**

1. **Online Tool:** https://dnschecker.org
   - Type: `send.tiket.pengempuw.com`
   - Record Type: `TXT`
   - Click **Search**
   - Should show your SPF record globally

2. **Command Line (Windows PowerShell):**
   ```powershell
   # Check TXT record
   nslookup -type=TXT send.tiket.pengempuw.com
   
   # Check MX record
   nslookup -type=MX send.tiket.pengempuw.com
   ```

**Expected Output:**
```
send.tiket.pengempuw.com    text = "v=spf1 include:amazons..."
```

**Wait Time:**
- Cloudflare: ~5 minutes (fast!)
- GoDaddy: ~10-30 minutes
- Others: up to 1 hour

---

### **Step 4: Verify Domain in Resend**

After DNS records are live:

1. Go back to Resend dashboard: https://resend.com/domains
2. Find your domain: `tiket.pengempuw.com`
3. Click **"Verify Domain"** button
4. Status should change to: **"✅ Verified"**

**If verification fails:**
- Wait longer (DNS might not be fully propagated)
- Double-check DNS records (typo?)
- Use dnschecker.org to confirm records visible globally
- Contact Resend support if still failing

---

### **Step 5: Update Railway Configuration**

Once domain is **VERIFIED** in Resend:

**Option A: Via Railway CLI**
```powershell
railway variables --set MAIL_FROM_ADDRESS=noreply@tiket.pengempuw.com
```

**Option B: Via Railway Dashboard**
1. Go to: https://railway.app/project/YOUR_PROJECT
2. Click your service: **Pengempu-Waterfall**
3. Go to **Variables** tab
4. Find `MAIL_FROM_ADDRESS`
5. Change value to: `noreply@tiket.pengempuw.com`
6. Click **Save**
7. Service will auto-redeploy (~1-2 min)

---

### **Step 6: Update Code - Remove Recipient Override**

**Files to edit:**
1. `app/Http/Controllers/Admin/OrderAdminController.php`
2. `app/Http/Controllers/BookingController.php`
3. `app/Http/Controllers/MidtransController.php`

**Find this code (search for "TEMPORARY FIX"):**
```php
// TEMPORARY FIX: Resend free account only sends to pengempuw@gmail.com
$recipientEmail = env('APP_ENV') === 'production' ? 'pengempuw@gmail.com' : $order->email;

Log::warning('Resend limitation: sending to verified email only', [
    'original_recipient' => $order->email,
    'actual_recipient' => $recipientEmail,
]);

ResendMailer::send(
    from: sprintf('%s <%s>', (string) config('mail.from.name', 'Admin'), (string) config('mail.from.address', 'onboarding@resend.dev')),
    to: $recipientEmail,
    subject: 'Tiket Resmi - ' . $order->order_id . ' (untuk: ' . $order->email . ')',
    html: $html
);
```

**Replace with:**
```php
// Domain verified - can send to any email now!
ResendMailer::send(
    from: sprintf('%s <%s>', (string) config('mail.from.name', 'Admin'), (string) config('mail.from.address', 'noreply@tiket.pengempuw.com')),
    to: (string) $order->email,  // ← Send to actual customer email
    subject: 'Tiket Resmi - ' . $order->order_id,
    html: $html
);
```

**Commit & Push:**
```powershell
git add -A
git commit -m "feat: enable direct customer email sending with verified domain"
git push
```

---

### **Step 7: Test Full Flow**

After deployment:

1. **Create Test Order:**
   - Use different email: `test@gmail.com`
   - Complete payment (sandbox mode)
   - Check settlement

2. **Check Customer Email:**
   - Email should arrive at: `test@gmail.com`
   - FROM: `Admin Waterfall Pengempu <noreply@tiket.pengempuw.com>`
   - Subject: `Tiket Resmi - ORDER-xxx`
   - Body: Full ticket with QR code

3. **Test Admin Resend:**
   - Dashboard → Orders → Resend Ticket
   - Should send to customer email directly

4. **Monitor Resend Dashboard:**
   - https://resend.com/emails
   - Check delivery status
   - Look for bounces/complaints

---

## 🎯 EXPECTED RESULTS

### **Before Domain Verification:**
- ❌ Can only send to `pengempuw@gmail.com`
- ❌ FROM: `onboarding@resend.dev` (generic)
- ❌ Subject has `(untuk: customer@email.com)` workaround

### **After Domain Verification:**
- ✅ Can send to **ANY email address**
- ✅ FROM: `noreply@tiket.pengempuw.com` (professional)
- ✅ Subject clean: `Tiket Resmi - ORDER-xxx`
- ✅ Customer receives email automatically
- ✅ **PRODUCTION READY!**

---

## 📊 EMAIL LIMITS

**With Verified Domain:**
- **Free Tier:** 3,000 emails/month
- **Pro Plan ($20/mo):** 50,000 emails/month
- **Rate Limit:** 10 emails/second

**For Pengempu Waterfall:**
- Average: ~100-500 tickets/month
- Free tier is MORE THAN ENOUGH!

---

## 🔧 TROUBLESHOOTING

### **Issue: Domain verification stuck**
**Solution:**
```powershell
# Check DNS with multiple tools
nslookup -type=TXT send.tiket.pengempuw.com 8.8.8.8
nslookup -type=MX send.tiket.pengempuw.com 8.8.8.8

# Or use online: https://dnschecker.org
```

### **Issue: Email still going to spam**
**Solution:**
- Add DMARC record (optional but helps)
- Check SPF/DKIM records configured correctly
- Warm up domain (send gradually, don't spam)
- Avoid spam trigger words in subject/body

### **Issue: Can't send after domain change**
**Solution:**
- Clear Railway config cache: `railway run php artisan config:clear`
- Restart Railway service
- Check Railway variables updated: `railway variables`

---

## 🚀 DEPLOYMENT CHECKLIST

**Before Going Live:**
- [ ] DNS records added and propagated
- [ ] Domain verified in Resend (✅ green checkmark)
- [ ] Railway MAIL_FROM_ADDRESS updated
- [ ] Code updated (recipient override removed)
- [ ] Tested with real customer email
- [ ] Checked email deliverability (inbox, not spam)
- [ ] Monitored Resend dashboard for issues

**After Going Live:**
- [ ] Monitor first 10 bookings closely
- [ ] Check customer feedback on email receipt
- [ ] Watch Resend dashboard for bounces
- [ ] Set up DMARC reporting (optional)

---

## 📧 RECOMMENDED FROM ADDRESSES

**Good Options:**
- ✅ `noreply@tiket.pengempuw.com` (no-reply, transactional)
- ✅ `tiket@tiket.pengempuw.com` (friendly)
- ✅ `booking@tiket.pengempuw.com` (descriptive)
- ✅ `info@tiket.pengempuw.com` (professional)

**Avoid:**
- ❌ `admin@tiket.pengempuw.com` (looks internal)
- ❌ `test@tiket.pengempuw.com` (not professional)

**Current Setup:**
```
FROM: Admin Waterfall Pengempu <noreply@tiket.pengempuw.com>
```
**This is PERFECT!** ✅

---

## 📌 SUMMARY

**What You're Doing:**
Adding custom domain `tiket.pengempuw.com` to Resend for email sending.

**Why It's Important:**
- Send to unlimited customers
- Professional appearance
- Production-ready
- Better deliverability

**Total Time:**
- DNS setup: 10 minutes
- DNS propagation: 5-30 minutes
- Code update: 5 minutes
- **Total: ~30-45 minutes**

**Next Step:**
Tell me where you manage `pengempuw.com` DNS (Cloudflare? GoDaddy? Niagahoster?), and I'll give you EXACT steps to add the records! 🎯
