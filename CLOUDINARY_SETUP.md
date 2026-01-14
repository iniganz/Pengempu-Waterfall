## Setup Cloudinary untuk Gallery Upload

### 1. Credentials Cloudinary
Setelah sign up di https://cloudinary.com, dapatkan credentials dari Dashboard:
- Cloud Name
- API Key
- API Secret

### 2. Set Environment Variables di Railway

Di Railway Dashboard → Variables, tambahkan:
```
CLOUDINARY_CLOUD_NAME=your_cloud_name
CLOUDINARY_API_KEY=your_api_key
CLOUDINARY_API_SECRET=your_api_secret
CLOUDINARY_URL=cloudinary://api_key:api_secret@cloud_name
```

### 3. Update .env.example (sudah dilakukan)
```
CLOUDINARY_CLOUD_NAME=
CLOUDINARY_API_KEY=
CLOUDINARY_API_SECRET=
CLOUDINARY_URL=
```

### 4. Cara Menggunakan di Controller

**GalleryAdminController** sudah di-update untuk support Cloudinary:

Upload ke Cloudinary:
```php
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

// Upload gambar
$uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), [
    'folder' => 'pengempu-waterfall/products',
    'resource_type' => 'image'
])->getSecurePath();

// Simpan URL ke database
ProductImage::create([
    'product_id' => $product->id,
    'image_url' => $uploadedFileUrl, // URL lengkap dari Cloudinary
]);
```

### 5. Update View untuk Handle Cloudinary URL

View sudah di-update untuk detect URL:
- Jika `image_url` mulai dengan `http://` atau `https://` → langsung pakai URL
- Jika mulai dengan `images/` → pakai `asset()`
- Jika tidak → pakai `asset('storage/' . $image_url)`

### 6. Delete dari Cloudinary

```php
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

// Extract public_id dari URL
$publicId = 'pengempu-waterfall/products/abc123';
Cloudinary::destroy($publicId);
```

### 7. Keuntungan Cloudinary:
- ✅ File tersimpan permanen
- ✅ CDN global (loading cepat)
- ✅ Auto image optimization
- ✅ Free tier 25 GB/month
- ✅ Transformasi gambar otomatis (resize, crop, dll)

### 8. Testing Local
Set di `.env` lokal:
```
CLOUDINARY_CLOUD_NAME=demo
CLOUDINARY_API_KEY=demo-key
CLOUDINARY_API_SECRET=demo-secret
```

### 9. Alternative: Railway Volume (Tanpa Cloudinary)

Jika tidak mau pakai Cloudinary:
1. Railway Dashboard → Service Settings → Volumes
2. New Volume → Mount path: `/app/storage/app/public`
3. Tetap pakai disk `public` seperti sekarang

Tapi Cloudinary lebih recommended untuk production karena:
- File tidak hilang walaupun volume corrupt
- Loading lebih cepat (CDN)
- Bisa akses dari mana saja
