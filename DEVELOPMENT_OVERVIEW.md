# 🏞️ Pengempu Waterfall - Development Overview

## 📋 Deskripsi Project

**Pengempu Waterfall** adalah aplikasi web untuk sistem booking tiket wisata Air Terjun Pengempu di Bali. Aplikasi ini dibangun menggunakan **Laravel 12** dan di-deploy di **Railway.app**.

---

## 🛠️ Tech Stack

| Komponen | Teknologi |
|----------|-----------|
| **Backend Framework** | Laravel 12.9.2 |
| **PHP Version** | 8.2.30 |
| **Database** | MySQL (Railway) |
| **Frontend** | Blade Templates + Tailwind CSS + Bootstrap 5 |
| **Payment Gateway** | Midtrans (Snap) |
| **Email Service** | Brevo HTTP API |
| **Hosting/Deployment** | Railway.app |
| **Version Control** | Git + GitHub |

---

## 🏗️ Arsitektur Aplikasi

```
┌─────────────────────────────────────────────────────────────────┐
│                        FRONTEND (Blade)                         │
│  ┌──────────┐ ┌──────────┐ ┌──────────┐ ┌──────────┐           │
│  │   Home   │ │ Product  │ │  Booking │ │  Gallery │           │
│  └──────────┘ └──────────┘ └──────────┘ └──────────┘           │
└─────────────────────────────────────────────────────────────────┘
                              │
                              ▼
┌─────────────────────────────────────────────────────────────────┐
│                     LARAVEL CONTROLLERS                         │
│  ┌────────────────┐  ┌────────────────┐  ┌────────────────┐    │
│  │BookingController│  │MidtransController│ │GalleryController│   │
│  └────────────────┘  └────────────────┘  └────────────────┘    │
└─────────────────────────────────────────────────────────────────┘
                              │
              ┌───────────────┼───────────────┐
              ▼               ▼               ▼
┌──────────────────┐ ┌──────────────┐ ┌──────────────────┐
│   MySQL Database │ │   Midtrans   │ │   Brevo Email    │
│    (Railway)     │ │  (Payment)   │ │   (HTTP API)     │
└──────────────────┘ └──────────────┘ └──────────────────┘
```

---

## 📁 Struktur Folder Utama

```
app/
├── Http/Controllers/
│   ├── BookingController.php      # Handle booking tiket
│   ├── MidtransController.php     # Webhook payment Midtrans
│   ├── TicketController.php       # Verifikasi & validasi tiket
│   ├── GalleryPostController.php  # Gallery foto pengunjung
│   ├── KontakController.php       # Form kontak
│   └── Admin/
│       ├── OrderAdminController.php    # Manajemen order
│       ├── GalleryAdminController.php  # Manajemen gallery produk
│       └── PlaceController.php         # Manajemen tempat wisata
├── Models/
│   ├── Order.php          # Data pesanan
│   ├── Ticket.php         # Data tiket (QR code)
│   ├── Product.php        # Data produk wisata
│   ├── GalleryPost.php    # Foto dari pengunjung
│   └── Place.php          # Tempat wisata sekitar
├── Services/
│   ├── BrevoMailer.php    # HTTP API untuk kirim email via Brevo
│   └── ResendMailer.php   # Alternatif email service
└── Helpers/
    ├── PageHelper.php     # Helper untuk wave SVG per halaman
    └── TicketHelper.php   # Helper generate tiket
```

---

## 🎫 Alur Booking Tiket (Main Feature)

### Flow Diagram

```
┌──────────────┐     ┌──────────────┐     ┌──────────────┐
│   CUSTOMER   │────▶│   BOOKING    │────▶│   PAYMENT    │
│ Pilih Tiket  │     │  Form Data   │     │   Midtrans   │
└──────────────┘     └──────────────┘     └──────────────┘
                                                 │
                                                 ▼
┌──────────────┐     ┌──────────────┐     ┌──────────────┐
│   SCAN QR    │◀────│  EMAIL SENT  │◀────│   WEBHOOK    │
│   di Lokasi  │     │  dengan QR   │     │  Settlement  │
└──────────────┘     └──────────────┘     └──────────────┘
```

### Detail Flow:

#### 1️⃣ Customer Memilih Tiket
```
Route: GET /product
Controller: ProductController@show
View: resources/views/publik/page/product.blade.php
```
- Menampilkan informasi produk wisata
- Harga tiket: IDR 30.000/orang
- Tombol "Book Now" mengarah ke halaman booking

#### 2️⃣ Mengisi Form Booking
```
Route: GET /booking/{product}
Controller: BookingController@index
View: resources/views/booking/index.blade.php
```
- Input: Nama, Email, Tanggal Kunjungan, Jumlah Tiket
- Validasi form sebelum submit

#### 3️⃣ Proses Payment (Midtrans)
```
Route: POST /booking/{product}
Controller: BookingController@store
```
- Generate Order ID unik
- Simpan data order ke database (status: pending)
- Request Snap Token dari Midtrans
- Tampilkan popup pembayaran Midtrans

#### 4️⃣ Webhook dari Midtrans
```
Route: POST /midtrans/webhook
Controller: MidtransController@handle
```
- Terima notifikasi dari Midtrans
- Verifikasi signature
- Update status order: `settlement` / `expire` / `cancel`
- Jika `settlement`:
  - Generate Ticket dengan QR Code
  - Kirim email tiket ke customer

#### 5️⃣ Email Tiket Terkirim
```
Service: App\Services\BrevoMailer
Template: resources/views/mail/ticket.blade.php
```
- Email berisi:
  - Detail order (nama, tanggal, jumlah)
  - QR Code untuk scan di lokasi
  - Link verifikasi tiket

#### 6️⃣ Scan QR di Lokasi
```
Route: GET /ticket/verify/{token}  (Public - untuk pengunjung)
Route: GET /ticket/validate/{token} (Auth - untuk pengelola)
Controller: TicketController
```
- Pengunjung scan QR → lihat status tiket
- Pengelola scan → validasi & tandai tiket sudah digunakan

---

## 🖼️ Alur Upload Gallery

### Flow untuk Pengunjung (Post Foto)

```
┌──────────────┐     ┌──────────────┐     ┌──────────────┐
│  PENGUNJUNG  │────▶│ UPLOAD FOTO  │────▶│   PENDING    │
│  /post-foto  │     │ + Caption    │     │   REVIEW     │
└──────────────┘     └──────────────┘     └──────────────┘
                                                 │
                                                 ▼
┌──────────────┐     ┌──────────────┐     ┌──────────────┐
│   TAMPIL DI  │◀────│   APPROVE    │◀────│    ADMIN     │
│   /galery    │     │   by Admin   │     │   REVIEW     │
└──────────────┘     └──────────────┘     └──────────────┘
```

### Detail:
```
Upload: POST /post-foto → GalleryPostController@store
- Gambar disimpan sebagai Base64 di database (image_data)
- Status default: pending

Admin Review: /dashboard/post
- Approve → status: approved → tampil di gallery
- Reject → status: rejected → tidak tampil
```

### Flow untuk Admin (Gallery Produk)

```
Route: /dashboard/gallery
Controller: GalleryAdminController
```
- Upload gambar untuk halaman produk
- Set gambar utama (main image)
- Gambar disimpan sebagai Base64 di database

---

## 🌐 Alur Explore Sekitar

```
┌──────────────┐     ┌──────────────┐     ┌──────────────┐
│    ADMIN     │────▶│ TAMBAH PLACE │────▶│   DATABASE   │
│  /dashboard  │     │ + Koordinat  │     │    places    │
└──────────────┘     └──────────────┘     └──────────────┘
                                                 │
                                                 ▼
┌──────────────┐     ┌──────────────┐     ┌──────────────┐
│   CUSTOMER   │────▶│ LIHAT JARAK  │◀────│  GEOLOCATION │
│/explore-sekitar│    │  dari User   │     │   Browser    │
└──────────────┘     └──────────────┘     └──────────────┘
```

- Admin menambah tempat wisata sekitar (kuliner, wisata, UMKM)
- Customer bisa melihat jarak dari lokasi mereka
- Menggunakan Haversine formula untuk kalkulasi jarak

---

## 📧 Sistem Email (Brevo HTTP API)

### Kenapa Brevo?
```
❌ Gmail SMTP → Railway blokir port 587/465
❌ Resend → Free tier hanya ke verified email
❌ SendGrid → Signup diblokir
✅ Brevo → HTTP API, 300 email/hari gratis, langsung ke customer
```

### Implementasi:
```php
// app/Services/BrevoMailer.php
public static function send($to, $subject, $html, $from = null)
{
    return Http::withHeaders([
        'api-key' => env('BREVO_API_KEY'),
        'Content-Type' => 'application/json',
    ])->post('https://api.brevo.com/v3/smtp/email', [
        'sender' => ['email' => $fromEmail, 'name' => $fromName],
        'to' => [['email' => $to]],
        'subject' => $subject,
        'htmlContent' => $html,
    ]);
}
```

---

## 💾 Penyimpanan Gambar (Base64 Database)

### Kenapa Base64 di Database?
```
❌ Local Storage → Railway filesystem ephemeral (hilang saat restart)
❌ Cloudinary → Package error di Laravel 12
✅ Base64 Database → Permanen, tidak perlu external service
```

### Implementasi:
```php
// Upload gambar
$file = $request->file('image');
$mimeType = $file->getMimeType();
$base64 = 'data:' . $mimeType . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));

// Simpan ke database
GalleryPost::create([
    'image_path' => 'database',
    'image_data' => $base64,  // LONGTEXT column
]);

// Tampilkan di view
<img src="{{ $post->image_data }}">
```

### Tabel yang menggunakan Base64:
- `gallery_posts.image_data` - Foto pengunjung
- `product_images.image_data` - Gambar produk
- `places.image_data` - Gambar tempat wisata

---

## 🔐 Autentikasi & Authorization

### Routes Protected:
```php
Route::middleware('auth')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard/orders', ...);
    Route::get('/dashboard/gallery', ...);
    Route::get('/dashboard/post', ...);
    Route::get('/dashboard/places', ...);
    Route::get('/dashboard/testimonials', ...);
    
    // Ticket Validation (untuk pengelola)
    Route::get('/ticket/validate/{token}', ...);
});
```

### Public Routes:
```php
// Semua orang bisa akses
Route::get('/', ...);              // Home
Route::get('/product', ...);       // Lihat produk
Route::get('/booking/{product}', ...); // Booking
Route::get('/galery', ...);        // Gallery
Route::get('/ticket/verify/{token}', ...); // Verifikasi tiket (scan QR)
```

---

## 🎨 Frontend Components

### Wave SVG Dynamic
```php
// app/Helpers/PageHelper.php
$waveClasses = [
    'home' => 'w-home',        // #FFF1CA (kuning)
    'galery' => 'w-default',   // #FFFFFF (putih)
    'product' => 'w-third',    // #F4F6F5 (abu-abu)
];

// resources/views/components/svg-waves.blade.php
// Background wave mengikuti halaman untuk transisi mulus ke footer
```

### Responsive Design
- Desktop: Grid layout untuk gallery
- Mobile: Horizontal scroll untuk gallery
- Tailwind CSS untuk utility classes
- Bootstrap 5 untuk komponen UI

---

## 🚀 Deployment (Railway)

### Environment Variables:
```env
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=mysql
DB_HOST=railway-mysql-host
MAIL_MAILER=brevo
BREVO_API_KEY=xkeysib-xxx
MIDTRANS_SERVER_KEY=xxx
MIDTRANS_CLIENT_KEY=xxx
MIDTRANS_IS_PRODUCTION=true
```

### Build Command:
```bash
composer install --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Temporary Routes (untuk maintenance):
```
/run-migrations    → Jalankan migration
/clear-all-cache   → Clear semua cache
/debug-*           → Debug routes (hapus setelah production)
```

---

## 📊 Database Schema

### Core Tables:

```sql
-- Orders (Pesanan)
orders
├── id
├── order_id (unique, format: ORDER-XXXXXX)
├── name
├── email
├── visit_date
├── quantity
├── total_price
├── payment_status (pending/settlement/expire/cancel)
└── timestamps

-- Tickets (Tiket dengan QR)
tickets
├── id
├── order_id (FK)
├── ticket_code (unique)
├── qr_token (UUID untuk URL)
├── is_used (boolean)
├── used_at
└── timestamps

-- Gallery Posts (Foto Pengunjung)
gallery_posts
├── id
├── name
├── caption
├── image_path
├── image_data (LONGTEXT - base64)
├── status (pending/approved/rejected)
└── timestamps

-- Product Images (Gambar Produk)
product_images
├── id
├── product_id (FK)
├── image_url
├── image_data (LONGTEXT - base64)
└── timestamps

-- Places (Tempat Wisata Sekitar)
places
├── id
├── name, slug
├── category (wisata/kuliner/umkm)
├── description
├── rating
├── address, lat, lng
├── image, image_data (LONGTEXT - base64)
└── timestamps
```

---

## 🔧 Troubleshooting yang Sudah Diselesaikan

| Problem | Solusi |
|---------|--------|
| Email tidak terkirim (SMTP blocked) | Gunakan Brevo HTTP API |
| Gambar hilang setelah redeploy | Simpan base64 di database |
| View gallery blank | Modal popup untuk base64 images |
| Wave SVG warna tidak sesuai | Apply background langsung di SVG style |
| Migration tidak jalan di Railway | Buat route `/run-migrations` |

---

## 📝 Catatan Development

1. **Selalu test di local** sebelum push ke production
2. **Clear cache** setelah deploy perubahan config/view
3. **Backup database** sebelum jalankan migration baru
4. **Monitor email quota** Brevo (300/hari free tier)
5. **Hapus debug routes** sebelum production final

---

## 👥 Tim Development

- **Developer**: [Nama Anda]
- **Repository**: https://github.com/iniganz/Pengempu-Waterfall
- **Production URL**: https://pengempu-waterfall-production.up.railway.app

---

*Dokumentasi ini dibuat pada: 15 Januari 2026*
