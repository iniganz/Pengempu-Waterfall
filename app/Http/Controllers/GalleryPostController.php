<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GalleryPost;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class GalleryPostController extends Controller
{
    // Tampilkan form upload foto
    public function create()
    {
        return view('publik.page.gallery_post');
    }

    // Proses upload foto
    public function store(Request $request)
    {
        try {
            Log::info('Gallery upload attempt', [
                'request_data' => $request->except('image'),
                'file_exists' => $request->hasFile('image'),
                'file_valid' => $request->file('image') ? $request->file('image')->isValid() : false,
            ]);

            $validated = $request->validate([
                'name' => 'required|string|max:100',
                'caption' => 'nullable|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            Log::info('Validation passed');

            // Upload ke Cloudinary jika dikonfigurasi, otherwise local storage
            if (env('CLOUDINARY_URL') || env('CLOUDINARY_CLOUD_NAME')) {
                Log::info('Uploading to Cloudinary...');

                $uploadedFile = Cloudinary::upload($request->file('image')->getRealPath(), [
                    'folder' => 'pengempu-gallery',
                    'transformation' => [
                        'quality' => 'auto',
                        'fetch_format' => 'auto',
                    ]
                ]);

                $path = $uploadedFile->getSecurePath(); // Full HTTPS URL
                Log::info('Cloudinary upload success: ' . $path);
            } else {
                // Fallback ke local storage
                $path = $request->file('image')->store('gallery_posts', 'public');
                Log::info('File stored locally at: ' . $path);
            }

            // Simpan ke database
            $post = GalleryPost::create([
                'name' => $validated['name'],
                'caption' => $validated['caption'] ?? null,
                'image_path' => $path,
                'status' => 'pending',
            ]);

            Log::info('Gallery post created with ID: ' . $post->id);

            return redirect()->route('galery')->with([
                'success' => 'Foto berhasil diupload!',
                'pending_post_id' => $post->id,
                'pending_post_name' => $post->name,
            ]);
        } catch (\Exception $e) {
            Log::error('Gallery upload error: ' . $e->getMessage(), [
                'exception' => $e,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    // Galeri publik: tampilkan hanya foto approved, filter terbaru/terlama
    public function publicGallery(Request $request)
    {
        $filter = $request->get('filter', 'latest');
        $query = GalleryPost::where('status', 'approved');
        if ($filter === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Adaptive pagination:
        // Mobile: 6 items/page (2 kolom × 3 baris)
        // Tablet: 9 items/page (3 kolom × 3 baris)
        // Desktop: 12 items/page (3 kolom × 4 baris)

        $perPage = 12; // Default desktop

        // Detect device dari User-Agent
        $userAgent = $request->header('User-Agent') ?? '';
        $isMobile = stripos($userAgent, 'mobile') !== false ||
                   stripos($userAgent, 'android') !== false ||
                   stripos($userAgent, 'iphone') !== false ||
                   stripos($userAgent, 'ipad') !== false;

        if ($isMobile) {
            $perPage = 6; // Mobile: 6 items
        }

        $galleryPosts = $query->paginate($perPage);

        return view('publik.page.gallery', compact('galleryPosts', 'filter'));
    }

    // Dashboard admin: list semua post
    public function adminIndex(Request $request)
    {
        $filter = $request->get('filter', 'latest');
        $query = GalleryPost::query();
        if ($filter === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }
        $posts = $query->paginate(15);
        return view('dashboard.postPhoto.index', compact('posts', 'filter'));
    }

    // Approve post
    public function approve($id)
    {
        $post = GalleryPost::findOrFail($id);
        $post->status = 'approved';
        $post->save();
        return back()->with('success', 'Foto berhasil di-approve!');
    }

    // Reject post
    public function reject($id)
    {
        $post = GalleryPost::findOrFail($id);
        $post->status = 'rejected';
        $post->save();
        return back()->with('success', 'Foto berhasil di-reject!');
    }

    // Hapus post (admin)
    public function destroy($id)
    {
        $post = GalleryPost::findOrFail($id);
        // Hapus file gambar dari storage
        if (Storage::disk('public')->exists($post->image_path)) {
            Storage::disk('public')->delete($post->image_path);
        }
        $post->delete();
        return back()->with('success', 'Post berhasil dihapus!');
    }
}
