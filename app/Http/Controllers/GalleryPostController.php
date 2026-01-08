<?php

            namespace App\Http\Controllers;

            use Illuminate\Http\Request;
            use App\Models\GalleryPost;
            use Illuminate\Support\Facades\Storage;

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
                    $validated = $request->validate([
                        'name' => 'required|string|max:100',
                        'caption' => 'nullable|string|max:255',
                        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                    ]);

                    // Simpan file
                    $path = $request->file('image')->store('gallery_posts', 'public');

                    // Simpan ke database
                    GalleryPost::create([
                        'name' => $validated['name'],
                        'caption' => $validated['caption'] ?? null,
                        'image_path' => $path,
                        'status' => 'pending',
                    ]);

                    return redirect()->route('galery')->with('success', 'Foto berhasil diupload, menunggu persetujuan admin.');
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
                    $galleryPosts = $query->paginate(12);
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
