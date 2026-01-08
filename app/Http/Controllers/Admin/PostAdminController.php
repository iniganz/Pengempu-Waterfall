<?php

namespace App\Http\Controllers\Admin;

use App\Models\GalleryPost;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class PostAdminController extends Controller
{
    // List semua post photo pengunjung
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'latest');
        $query = GalleryPost::query();
        if ($filter === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }
        $posts = $query->paginate(15);
        return view('dashboard.postPhoto.approval', compact('posts', 'filter'));
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

    // Hapus post
    public function destroy($id)
    {
        $post = GalleryPost::findOrFail($id);
        if (Storage::disk('public')->exists($post->image_path)) {
            Storage::disk('public')->delete($post->image_path);
        }
        $post->delete();
        return back()->with('success', 'Post berhasil dihapus!');
    }
}
