# QUICK REFERENCE - Sistem Tiket QR Code

## 🎯 Endpoints

### Public Endpoints (Tidak perlu login)
```
GET /ticket/verify/{token}
→ Pengunjung melihat detail tiket
→ Increment scan_count
→ View: publik/ticket/verify.blade.php
```

### Protected Endpoints (Perlu login)
```
GET /ticket/validate/{token}
→ Pengelola validasi tiket
→ Update is_used, validated_by, validated_at
→ View: publik/ticket/validate.blade.php

GET /ticket/scan
→ Dashboard scanning interface untuk pengelola
→ View: publik/ticket/scan-dashboard.blade.php
```

---

## 📊 Database Fields

### Tickets Table
| Field | Type | Purpose |
|-------|------|---------|
| `is_used` | boolean | Apakah sudah divalidasi pengelola (default: false) |
| `used_at` | timestamp | Waktu pertama scan (tidak dipakai lagi) |
| `validated_by` | bigint | User ID pengelola yang validasi |
| `validated_at` | timestamp | Waktu validasi oleh pengelola |
| `scan_count` | int | Jumlah kali di-scan |

---

## 🔍 Check Status Tiket

### Di View/Controller
```php
$ticket->isValidated()    // true/false - sudah divalidasi pengelola
$ticket->isScannedOnly()  // true/false - di-scan tapi belum divalidasi
$ticket->validator()      // User model - siapa yang validasi
```

---

## 💡 Use Cases

### Case 1: Pengunjung Scan
```
Flow: Pengunjung → Scan QR → /ticket/verify/{token}
Response:
  ✓ Belum divalidasi → "Tiket Valid - Detail terlihat"
  ✓ Scan count bertambah
  ✓ Bisa scan berkali-kali
```

### Case 2: Pengelola Validasi
```
Flow: Pengelola (login) → Scan QR → /ticket/validate/{token}
Response:
  ✓ Berhasil → "Tiket Divalidasi + catat pengelola"
  ✓ Update is_used = true
  ✓ Hanya bisa divalidasi 1x
```

### Case 3: Cek Status Setelah Validasi
```
Flow: Pengunjung Scan Lagi → /ticket/verify/{token}
Response:
  ✓ Terdeteksi sudah divalidasi → "Tiket Sudah Digunakan"
  ✓ Tampilkan siapa & kapan divalidasi
```

---

## 🛠️ Helper Functions

### TicketHelper (app/Helpers/TicketHelper.php)

```php
// Get tiket yang belum divalidasi tapi sudah discan
TicketHelper::getScannedButNotValidated()

// Get tiket yang divalidasi hari ini
TicketHelper::getTodayValidated()

// Get tiket dalam range tanggal
TicketHelper::getValidatedBetween($start, $end)

// Get tiket yang divalidasi user tertentu
TicketHelper::getValidatedByUser($userId)

// Get dashboard stats
TicketHelper::getDashboardStats($date)

// Check apakah tiket sudah terpakai
TicketHelper::isTicketUsed($ticketCode)

// Get ticket info lengkap
TicketHelper::getTicketInfo($qrToken)

// Check suspicious behavior (scan terlalu banyak)
TicketHelper::isSuspiciousBehavior($ticketId)

// Leaderboard pengelola
TicketHelper::getValidationLeaderboard($date)
```

---

## 📝 Model Methods

### Ticket Model
```php
$ticket->order()          // Relasi ke Order
$ticket->validator()      // Relasi ke User yang validasi

$ticket->isValidated()    // Check apakah sudah divalidasi
$ticket->isScannedOnly()  // Check apakah hanya di-scan

// Fillable
['order_id', 'ticket_code', 'qr_token', 'is_used', 'used_at',
 'validated_by', 'validated_at', 'scan_count']
```

---

## 🎨 Views

### verify.blade.php (Pengunjung)
```
Status: Tiket yang belum/sudah divalidasi
Display:
  - Detail tiket pengunjung
  - Instruksi "Tunjukkan ke pengelola"
  - Jika sudah divalidasi → catat pengelola & waktu
```

### validate.blade.php (Pengelola)
```
Status: Tiket yang baru divalidasi
Display:
  - Detail tiket
  - Nama pengelola yang validasi
  - Waktu validasi
  - Instruksi untuk pengelola
```

### scan-dashboard.blade.php (Dashboard Pengelola)
```
Interface:
  - Input field untuk scan QR
  - Info waktu & jumlah validasi hari ini
  - Recent tickets yang divalidasi
```

---

## 🔐 Security

✅ Only authenticated users can validate
✅ Audit trail (siapa & kapan validasi)
✅ One-time validation per ticket
✅ Foreign key constraint
✅ Payment status check

---

## 📋 Common Queries

### Tiket yang belum divalidasi
```php
Ticket::where('is_used', false)->get();
```

### Tiket yang sudah divalidasi
```php
Ticket::where('is_used', true)->get();
```

### Tiket yang divalidasi hari ini
```php
Ticket::whereDate('validated_at', today())->get();
```

### Tiket per order
```php
Order::find($id)->ticket;
```

### Siapa yang validasi tiket
```php
$ticket->validator->name;
$ticket->validated_at;
```

---

## 🧪 Testing URLs

```
Local Testing:
GET http://localhost/ticket/verify/[valid-token]
GET http://localhost/ticket/validate/[valid-token]  (need login)
GET http://localhost/ticket/scan  (need login)
```

---

## 📚 Files

| File | Purpose |
|------|---------|
| `app/Http/Controllers/TicketController.php` | Logic verify & validate |
| `app/Models/Ticket.php` | Model dengan relations |
| `app/Helpers/TicketHelper.php` | Helper functions |
| `resources/views/publik/ticket/verify.blade.php` | View pengunjung |
| `resources/views/publik/ticket/validate.blade.php` | View pengelola |
| `resources/views/publik/ticket/scan-dashboard.blade.php` | Dashboard scan |
| `routes/web.php` | Routes definition |
| `database/migrations/2026_01_04_*` | DB migration |

---

## 🚀 How to Use

1. **Migration sudah dijalankan** ✓
2. **Routes sudah ditambah** ✓
3. **Views sudah dibuat** ✓
4. **Akses:**
   - Pengunjung: buka email → scan QR → lihat detail
   - Pengelola: login → akses `/ticket/scan` → scan QR → validasi

---

## ❓ FAQ

**Q: Pengunjung bisa scan berkali-kali?**
A: Ya, scan berkali-kali diperbolehkan tapi tidak mengubah status tiket.

**Q: Hanya pengelola yang bisa membuat tiket invalid?**
A: Ya, hanya user yang login bisa akses endpoint validate.

**Q: Data siapa yang validasi tersimpan?**
A: Ya, di field `validated_by` (user_id) dan `validated_at` (timestamp).

**Q: Bisa di-undo kalau salah validasi?**
A: Belum ada fitur undo, perlu direct DB edit atau custom endpoint.

**Q: QR code sama untuk pengunjung & pengelola?**
A: Ya sama, tapi route berbeda (verify vs validate).

---

## 🔔 Notes

- Migration sudah run → cek `php artisan migrate:status`
- Pastikan user ada relation ke Ticket model ✓
- Email template sudah diupdate ✓
- Testing perlu tiket yang belum divalidasi & sudah settlement
