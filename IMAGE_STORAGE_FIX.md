# Image Storage Fix Guide

## Current Status

### ✅ Working Images:
- **Public images** (`public/images/`) - Load successfully
  - Example: `/images/air_terjun1.jpg`, `/images/Pengempu.png`
  - Used by ProductSeeder for demo products
  - **Persistent** across Railway restarts

### ❌ Broken Images:
- **Storage uploads** (`storage/app/public/`) - Returns 404
  - Example: `/storage/products/E5Xf9nrOwsfCLvZio8FHoJy1lp9qfNEa0Bfm0Or0.webp`
  - Uploaded via Gallery Admin or Product Admin
  - **Ephemeral** - Lost on Railway container restart

## Root Cause

Railway uses **ephemeral filesystem**:
- Anything written to disk AFTER deployment is lost on restart
- `storage/app/public/` is writable but temporary
- Only files in Git repo (`public/images/`) persist

## Current Workaround

Product blade view has helper function to handle both:

```php
// resources/views/publik/page/product.blade.php
$getImageUrl = function($imagePath) {
    // Check if it's a full URL (http/https)
    if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
        return $imagePath;
    }
    // Check if it starts with 'images/' (public folder)
    if (strpos($imagePath, 'images/') === 0) {
        return asset($imagePath);
    }
    // Otherwise use storage path
    return asset('storage/' . $imagePath);
};
```

## Permanent Solution: Cloudinary Integration

### Already Installed:
```bash
composer show cloudinary-labs/cloudinary-laravel
# cloudinary-labs/cloudinary-laravel 2.1.2
```

### Setup Steps:

1. **Add Cloudinary credentials to Railway:**
```bash
railway variables set CLOUDINARY_CLOUD_NAME=your_cloud_name
railway variables set CLOUDINARY_API_KEY=your_api_key
railway variables set CLOUDINARY_API_SECRET=your_api_secret
```

Get credentials from: https://console.cloudinary.com/

2. **Update `.env.example`:**
```env
CLOUDINARY_CLOUD_NAME=
CLOUDINARY_API_KEY=
CLOUDINARY_API_SECRET=
CLOUDINARY_URL=cloudinary://${CLOUDINARY_API_KEY}:${CLOUDINARY_API_SECRET}@${CLOUDINARY_CLOUD_NAME}
```

3. **Update GalleryPostController upload method:**
```php
use Cloudinary\Cloudinary;

public function store(Request $request)
{
    // ... validation ...
    
    // Upload to Cloudinary
    $uploadResult = cloudinary()->upload($request->file('image')->getRealPath(), [
        'folder' => 'pengempu-gallery',
        'resource_type' => 'image'
    ]);
    
    GalleryPost::create([
        'image_path' => $uploadResult->getSecurePath(), // Full Cloudinary URL
        'caption' => $request->caption,
    ]);
}
```

4. **Update ProductImage model or controller:**
```php
// When uploading product images
$uploadResult = cloudinary()->upload($image->getRealPath(), [
    'folder' => 'pengempu-products',
    'transformation' => [
        ['width' => 1200, 'height' => 800, 'crop' => 'limit'],
        ['quality' => 'auto'],
        ['fetch_format' => 'auto']
    ]
]);

ProductImage::create([
    'product_id' => $product->id,
    'image_url' => $uploadResult->getSecurePath()
]);
```

5. **View helper already handles Cloudinary URLs:**
```php
// Cloudinary URLs start with https://res.cloudinary.com/
if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
    return $imagePath; // ✅ Works for Cloudinary
}
```

## Temporary Solution: Document Warning

Add warning in Gallery Admin dashboard:
```html
<div class="alert alert-warning">
    ⚠️ <strong>Production Note:</strong> Uploaded images are stored temporarily. 
    They will be lost when the server restarts. 
    Use Cloudinary integration for permanent storage.
</div>
```

## Testing After Fix:

### Test 1: Public Images (Should work now)
1. Visit: https://pengempu-waterfall-production.up.railway.app/
2. Check: Air terjun images in hero section
3. ✅ Expected: All images load

### Test 2: Uploaded Images (Need Cloudinary)
1. Go to: https://pengempu-waterfall-production.up.railway.app/dashboard/gallery
2. Upload new image
3. ❌ Current: Image visible until restart
4. ✅ After Cloudinary: Image permanent

## Files Modified for Image Handling:

- `resources/views/publik/page/product.blade.php` - Helper function for multiple image sources
- `database/seeders/ProductSeeder.php` - Uses `images/` prefix for public folder
- `resources/views/dashboard/gallery/index.blade.php` - Warning about ephemeral storage

## Railway Storage Limitations:

| Storage Type | Path | Persistent? | Use Case |
|-------------|------|-------------|----------|
| Git Repo Files | `public/images/` | ✅ Yes | Demo images, static assets |
| Build Artifacts | `public/build/` | ✅ Yes | Compiled CSS/JS |
| Runtime Uploads | `storage/app/public/` | ❌ No | User uploads (need Cloudinary) |
| Logs | `storage/logs/` | ❌ No | Use Railway logs instead |
| Cache | `storage/framework/cache/` | ❌ No | Use database cache driver |

## Action Items:

- [ ] Get Cloudinary credentials
- [ ] Add Railway environment variables
- [ ] Update GalleryPostController for Cloudinary upload
- [ ] Update ProductAdminController for Cloudinary upload
- [ ] Test upload → restart → verify image still loads
- [ ] Remove ephemeral storage warning after Cloudinary working
