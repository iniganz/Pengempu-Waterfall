<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class GalleryAdminController extends Controller
{
    /**
     * Display gallery management page for Pengempu Waterfall
     */
    public function index()
    {
        try {
            $product = Product::with('images')
                ->where('slug', 'pengempu-waterfall')
                ->firstOrFail();

            return view('dashboard.gallery.index', compact('product'));
        } catch (\Exception $e) {
            Log::error('GalleryAdminController@index: ' . $e->getMessage());
            return back()->with('error', 'Error loading gallery: ' . $e->getMessage());
        }
    }

    /**
     * Upload new image
     */
    public function upload(Request $request)
    {
        try {
            $validated = $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
            ]);

            // Get Pengempu Waterfall product
            $product = Product::where('slug', 'pengempu-waterfall')->firstOrFail();

            DB::beginTransaction();

            // Store image
            try {
                // Upload ke Cloudinary jika dikonfigurasi
                if (env('CLOUDINARY_URL') || env('CLOUDINARY_CLOUD_NAME')) {
                    Log::info('Uploading product image to Cloudinary...');

                    $uploadedFile = Cloudinary::upload($request->file('image')->getRealPath(), [
                        'folder' => 'pengempu-products',
                        'transformation' => [
                            'quality' => 'auto',
                            'fetch_format' => 'auto',
                        ]
                    ]);

                    $path = $uploadedFile->getSecurePath(); // Full HTTPS URL
                    Log::info('Cloudinary upload success: ' . $path);
                } else {
                    // Fallback ke local storage
                    $path = $request->file('image')->store('products', 'public');
                    Log::info('File stored locally at: ' . $path);
                }

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $path,
                ]);
            } catch (\Exception $e) {
                Log::error('Image upload failed: ' . $e->getMessage());
                throw new \Exception('Failed to upload image: ' . $e->getMessage());
            }

            DB::commit();

            return back()->with('success', 'Image uploaded successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('GalleryAdminController@upload: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Set image as main/primary image
     *
     * @param ProductImage $productImage
     */
    public function setMain(ProductImage $productImage)
    {
        try {
            /** @var Product $product */
            $product = $productImage->product;
            if ($product->slug !== 'pengempu-waterfall') {
                return back()->with('error', 'Unauthorized action');
            }
            DB::beginTransaction();
            // Ambil semua image
            $images = $product->images()->orderBy('id')->get();
            if ($images->count() < 2) {
                return back()->with('error', 'Minimal 2 gambar untuk set main.');
            }
            // Tukar id gambar utama dengan yang dipilih
            /** @var ProductImage $main */
            $main = $images->first();
            // @phpstan-ignore-next-line - Model properties from Eloquent
            if ($main->id !== $productImage->id) {
                // Swap image_url
                $tmp = $main->image_url;
                $main->image_url = $productImage->image_url;
                $productImage->image_url = $tmp;
                $main->save();
                $productImage->save();
            }
            DB::commit();
            return back()->with('success', 'Image set as main image!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('GalleryAdminController@setMain: ' . $e->getMessage());
            return back()->with('error', 'Error updating image: ' . $e->getMessage());
        }
    }

    /**
     * Delete image
     *
     * @param ProductImage $productImage
     */
    public function deleteImage(ProductImage $productImage)
    {
        try {
            // Get product
            /** @var Product $product */
            $product = $productImage->product;

            // Verify it's Pengempu Waterfall product
            if ($product->slug !== 'pengempu-waterfall') {
                return back()->with('error', 'Unauthorized action');
            }

            // Ensure at least one image remains
            if ($product->images()->count() <= 1) {
                return back()->with('error', 'Cannot delete the last image. Product must have at least one image.');
            }

            DB::beginTransaction();

            // Delete file from storage
            // @phpstan-ignore-next-line - Model property from Eloquent
            try {
                if (Storage::disk('public')->exists($productImage->image_url)) {
                    Storage::disk('public')->delete($productImage->image_url);
                }
            } catch (\Exception $e) {
                Log::warning('Failed to delete image file: ' . $e->getMessage());
            }

            // Delete database record
            $productImage->delete();

            DB::commit();

            return back()->with('success', 'Image deleted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('GalleryAdminController@deleteImage: ' . $e->getMessage());
            return back()->with('error', 'Error deleting image: ' . $e->getMessage());
        }
    }
}
