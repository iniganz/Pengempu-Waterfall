# 🎟️ IMPLEMENTASI SISTEM TIKET QR CODE - RINGKASAN PERUBAHAN

## Problem yang Diselesaikan

**Masalah Lama:**
- ❌ Saat pengunjung scan QR → tiket langsung dianggap terpakai
- ❌ Saat orang lain scan QR → tiket juga dianggap terpakai
- ❌ Tidak ada pembedaan antara pengunjung vs pengelola

**Solusi Baru:**
- ✅ Pengunjung bisa scan QR berkali-kali tanpa berpengaruh ke status
- ✅ Hanya pengelola yang login bisa membuat tiket menjadi "terpakai"
- ✅ Tiket ditrack siapa & kapan di-validasi
- ✅ Sistem mencatat jumlah scan

---

## Files yang Dibuat/Diubah

### 1. **Database Migration**
📄 `database/migrations/2026_01_04_000000_add_manager_scan_to_tickets_table.php`

Menambah 3 kolom ke tabel `tickets`:
- `validated_by` (INT) - ID pengelola yang validasi
- `validated_at` (TIMESTAMP) - Waktu validasi
- `scan_count` (INT) - Berapa kali di-scan

**Jalankan:**
```bash
php artisan migrate
```

---

### 2. **Model Updates**
📄 `app/Models/Ticket.php`

Perubahan:
```php
// Fillable ditambah kolom baru
protected $fillable = [
    'order_id','ticket_code','qr_token','is_used','used_at',
    'validated_by','validated_at','scan_count'
];

// Relasi baru
public function validator() { ... }

// Helper methods
public function isValidated() { ... }
public function isScannedOnly() { ... }
```

---

### 3. **Controller - Pisahkan Logic**
📄 `app/Http/Controllers/TicketController.php`

**Method 1: `verify($token)` - Untuk Pengunjung**
- Tidak perlu login
- Cek tiket ada & pembayaran sudah settlement
- Increment `scan_count`
- Cek apakah sudah divalidasi pengelola
- Tampilkan view verify.blade.php

**Method 2: `validate($token)` - Untuk Pengelola**
- Memerlukan `auth()` middleware
- Cek tiket ada & pembayaran sudah settlement
- Update: `is_used = true`, `validated_at = now()`, `validated_by = auth()->id()`
- Tampilkan view validate.blade.php

---

### 4. **Routes**
📄 `routes/web.php`

```php
// PUBLIC - Pengunjung scan
Route::get('/ticket/verify/{token}', [TicketController::class, 'verify'])
    ->name('ticket.verify');

// PROTECTED - Pengelola validasi
Route::middleware('auth')->get('/ticket/validate/{token}', [TicketController::class, 'validate'])
    ->name('ticket.validate');

// Dashboard scanning interface
Route::middleware('auth')->get('/ticket/scan', function() {
    return view('publik.ticket.scan-dashboard');
})->name('ticket.scan');
```

---

### 5. **Views - 3 File Baru/Diubah**

#### A. `resources/views/publik/ticket/verify.blade.php` (DIUBAH)
- Halaman yang dilihat **pengunjung** saat scan
- Tampilkan detail tiket
- Instruksi "Tunjukkan halaman ini ke pengelola"
- Jika sudah divalidasi pengelola → tampilkan "Sudah Digunakan"

#### B. `resources/views/publik/ticket/validate.blade.php` (BARU)
- Halaman yang dilihat **pengelola** saat scan
- Tampilkan detail pengunjung + tiket
- Catat "Divalidasi oleh [nama pengelola]" + waktu
- Jika sudah divalidasi sebelumnya → tolak dengan info siapa yang validasi

#### C. `resources/views/publik/ticket/scan-dashboard.blade.php` (BARU)
- Interface dashboard untuk pengelola scan
- Input untuk token/scan barcode
- Update waktu & jumlah tiket hari ini
- Instruksi penggunaan

#### D. `resources/views/mail/ticket.blade.php` (DIUBAH)
- Update text: "QR dapat di-scan siapa saja untuk melihat detail, tapi hanya valid jika pengelola validasi"

---

### 6. **Dokumentasi**
📄 `TICKET_SYSTEM.md` - Dokumentasi lengkap sistem

---

## Alur Kerja Lengkap

### Scenario 1: Pengunjung Scan QR
```
1. Pengunjung dapat tiket lewat email
2. Scan QR Code
3. → /ticket/verify/{token}
4. → Lihat detail tiket mereka
5. → Instruksi "Tunjukkan ke pengelola"
6. → Scan count bertambah, tapi is_used tetap FALSE
```

### Scenario 2: Pengelola Validasi
```
1. Pengelola login ke dashboard
2. Buka /ticket/scan
3. Scan QR Code pengunjung
4. → /ticket/validate/{token}
5. → Update: is_used=true, validated_by=user_id, validated_at=now
6. → Tampilkan "Tiket Berhasil Divalidasi"
7. → Catat siapa & kapan validasi
```

### Scenario 3: Pengunjung Scan Lagi Setelah Pengelola Validasi
```
1. Pengunjung (atau orang lain) scan QR lagi
2. → /ticket/verify/{token}
3. → Cek: is_used=true & validated_by != null
4. → Tampilkan "Tiket Sudah Digunakan pada [waktu] oleh [nama pengelola]"
5. → Reject - scan_count tetap bertambah tapi tiket sudah invalid
```

---

## Database Schema Setelah Migration

```sql
CREATE TABLE tickets (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    order_id BIGINT NOT NULL,
    ticket_code VARCHAR(255) UNIQUE NOT NULL,
    qr_token VARCHAR(255) UNIQUE NOT NULL,
    is_used BOOLEAN DEFAULT FALSE,
    used_at TIMESTAMP NULL,
    validated_by BIGINT UNSIGNED NULL,          -- NEW
    validated_at TIMESTAMP NULL,                -- NEW
    scan_count INT DEFAULT 0,                   -- NEW
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (validated_by) REFERENCES users(id)
);
```

---

## Query Contoh

### Cek Tiket yang Belum Divalidasi Tapi Sudah Discan
```php
$tickets = Ticket::where('is_used', false)
    ->where('scan_count', '>', 0)
    ->with('order')
    ->get();
```

### Audit Trail - Siapa Validasi Tiket
```php
$ticket = Ticket::with('validator', 'order')->find($id);
echo "Validasi oleh: " . $ticket->validator->name;
echo "Waktu: " . $ticket->validated_at;
```

### Tiket Tervalidasi Hari Ini
```php
$todayValidated = Ticket::whereDate('validated_at', today())
    ->with('validator:id,name', 'order:id,name')
    ->orderByDesc('validated_at')
    ->get();
```

### Total Pengunjung Hari Ini
```php
$totalToday = Ticket::whereDate('validated_at', today())->count();
```

---

## Security Features

✅ **Authentication Check**: Hanya user yang login bisa akses `/ticket/validate`  
✅ **Audit Trail**: Catat siapa & kapan validasi  
✅ **One-Time Validation**: Tiket hanya bisa divalidasi 1x  
✅ **Foreign Key**: Validated_by reference ke users table  
✅ **Immutable Status**: Sekali divalidasi, tidak bisa di-undo tanpa direct DB edit  

---

## Testing Checklist

- [ ] Jalankan migration: `php artisan migrate`
- [ ] Test akses `/ticket/verify/{token}` tanpa login
  - [ ] Tampilkan detail tiket
  - [ ] Increment scan_count
  - [ ] Jangan ubah is_used
- [ ] Test akses `/ticket/validate/{token}` tanpa login
  - [ ] Redirect ke login
- [ ] Test akses `/ticket/validate/{token}` dengan login
  - [ ] Ubah is_used = true
  - [ ] Ubah validated_by & validated_at
  - [ ] Tampilkan info pengelola yang validasi
- [ ] Test scan 2x:
  - [ ] Pertama: valid ✓
  - [ ] Kedua: reject (sudah terpakai)
- [ ] Test `/ticket/scan` dashboard
  - [ ] Form input untuk token
  - [ ] Redirect ke /ticket/validate setelah submit

---

## Next Steps (Optional)

Untuk upgrade lebih lanjut bisa tambah:
1. **API Endpoint** untuk scan dari mobile app
2. **Export Report** tiket tervalidasi per hari
3. **Batch Validation** untuk scanning multiple tickets
4. **Refund System** jika tiket error bisa di-unvalidate
5. **QR berbeda untuk pengelola** (separate QR code)

---

## Support

Dokumentasi lengkap: `TICKET_SYSTEM.md`
