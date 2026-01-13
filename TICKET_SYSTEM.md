# Sistem Tiket QR Code - Dokumentasi

## Ringkasan Perubahan

Sistem tiket telah diperbarui untuk membedakan antara **verify** (pengunjung melihat) dan **validate** (pengelola konfirmasi entry).

## Alur Kerja

### 1. **Pengunjung Scan QR Code**
- **Endpoint**: `/ticket/verify/{token}` (PUBLIC - tidak perlu login)
- **Aksi**:
  - ✅ Menampilkan detail tiket mereka
  - ✅ Menghitung jumlah scan (scan_count++)
  - ❌ TIDAK mengubah status tiket (is_used tetap false)
  - ❌ TIDAK mengubah status menjadi terpakai

- **Respons**:
  - Jika tiket valid & belum divalidasi → Tampilkan "Tiket Valid ✓"
  - Jika tiket sudah divalidasi pengelola → Tampilkan "Tiket Sudah Digunakan"
  - Jika pembayaran belum settlement → Tampilkan "Pembayaran Belum Dikonfirmasi"

### 2. **Pengelola Scan QR Code**
- **Endpoint**: `/ticket/validate/{token}` (PROTECTED - perlu login)
- **Aksi**:
  - ✅ Menampilkan detail tiket pengunjung
  - ✅ Mengubah status tiket menjadi `is_used = true`
  - ✅ Mencatat waktu validasi (`validated_at`)
  - ✅ Mencatat siapa yang validasi (`validated_by` = user ID)
  - ❌ Jika sudah divalidasi, akan menolak dan tampilkan pesan sudah terpakai

- **Respons**:
  - Jika belum divalidasi → "Tiket Berhasil Divalidasi ✓"
  - Jika sudah divalidasi → "Tiket Sudah Divalidasi (ditampilkan siapa & kapan)"
  - Jika pembayaran belum settlement → "Pembayaran Belum Dikonfirmasi"

## Database Changes

### Kolom Baru di Tabel `tickets`
```sql
validated_by    INT UNSIGNED NULL      -- ID user yang validasi
validated_at    TIMESTAMP NULL         -- Waktu validasi
scan_count      INT DEFAULT 0          -- Jumlah kali di-scan
```

### Model Relations
```php
$ticket->validator()    // Mendapatkan user yang validasi
$ticket->isValidated()  // Check apakah sudah divalidasi pengelola
$ticket->isScannedOnly()// Check apakah hanya di-scan, belum divalidasi
```

## Implementasi di Code

### TicketController.php

**Method verify()** - Untuk pengunjung
- Cek tiket ada & pembayaran settlement
- Increment scan_count
- Cek apakah sudah divalidasi pengelola
- Tampilkan view sesuai status

**Method validate()** - Untuk pengelola
- Cek authentication (middleware auth)
- Cek tiket ada & pembayaran settlement
- Cek apakah sudah divalidasi
- Update `is_used`, `validated_at`, `validated_by`
- Tampilkan view dengan info pengelola

### Routes (web.php)
```php
// Public route
Route::get('/ticket/verify/{token}', [TicketController::class, 'verify'])
    ->name('ticket.verify');

// Protected route
Route::middleware('auth')->get('/ticket/validate/{token}', [TicketController::class, 'validate'])
    ->name('ticket.validate');
```

### Views
- `resources/views/publik/ticket/verify.blade.php` - Tampilan pengunjung
- `resources/views/publik/ticket/validate.blade.php` - Tampilan pengelola

## Cara Menggunakan

### Setup Awal
1. Jalankan migration:
```bash
php artisan migrate
```

2. Update email template sudah otomatis (QR tetap sama)

### Saat Live

**Pengunjung:**
1. Scan QR dari tiket email mereka
2. Halaman terbuka di `/ticket/verify/{token}`
3. Mereka lihat detail tiket mereka
4. Tunjukkan halaman ini ke pengelola

**Pengelola:**
1. Login ke dashboard (`/dashboard`)
2. Pergi ke Orders (`/dashboard/orders`)
3. Klik tombol scan QR (atau akses langsung `/ticket/validate/{token}`)
4. Halaman akan validasi & catat siapa + kapan

## QR Code Link

QR Code tetap mengacu ke endpoint yang sama, tapi sekarang:
- **First scan (pengunjung)** → `/ticket/verify/{token}` ← otomatis dalam email
- **Pengelola** → buka `/ticket/validate/{token}` (bisa dari dashboard)

## Query Berguna

### Cek tiket yang belum divalidasi tapi sudah di-scan
```php
Ticket::where('is_used', false)->where('scan_count', '>', 0)->get();
```

### Cek siapa yang validasi tiket tertentu
```php
$ticket = Ticket::find($id);
$validator = $ticket->validator;  // User model
echo $validator->name;
```

### Audit trail - tiket yang divalidasi hari ini
```php
Ticket::whereDate('validated_at', today())
    ->with('validator', 'order')
    ->get();
```

## Benefit dari Implementasi Ini

✅ **Keamanan**: Hanya pengelola yang login bisa validasi  
✅ **Transparansi**: Pengunjung bisa lihat detail tanpa dicek terpakai  
✅ **Audit**: Tercatat siapa & kapan validasi  
✅ **Flexible**: Pengunjung bisa scan berkali-kali, pengelola cukup 1x  
✅ **Anti Fraud**: Sulit untuk memalsukan validasi pengelola
