<?php

namespace App\Http\Controllers;
// use App\Helpers\TrixHelper;
use App\Models\Post;
use App\Models\Product;
use App\Models\Category;
use App\Models\Platform;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Search by slug or title
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('slug', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%");
            });
        }

        $posts = $query->with('category')->latest()->paginate(10)->withQueryString();

        return view('admin.page.post', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.page.create', [
            'categories' => Category::all(),
            'platforms' => Platform::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Upload gambar duluan (misal ke folder tmp)
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('tmp', 'public');
        } else {
            $path = null;
        }

        // Validasi
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:products,slug',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'feature' => 'required',
            'aditional' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'date' => 'required|date',
            'gallery' => 'array|max:4', // validasi gallery
            'gallery.*' => 'image|mimes:jpg,jpeg,png|max:2048', // validasi gallery

        ], [
            'gallery.max' => 'Maksimal 4 gambar untuk galeri.',
            'gallery.*.image' => 'Semua file di gallery harus berupa gambar.',
            'gallery.*.mimes' => 'Format gambar hanya boleh jpg, jpeg, atau png.',
            'gallery.*.max' => 'Ukuran gambar di gallery maksimal 2MB.',
        ]);

        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['image'] = $request->file('image')->store('', 'public');
        $plainText = $this->cleanTrixContent($request->description);
        $plainText = $this->cleanTrixContent($request->feature);
        $plainText = $this->cleanTrixContent($request->aditional);
        $validatedData['excerpt'] = Str::limit($plainText, 200);



        $product = Product::create($validatedData);

        if ($request->has('platforms')) {
            $product->platforms()->sync($request->platforms);
        }

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $galleryImage) {
                $galleryPath = $galleryImage->store('', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $galleryPath,
                ]);
            }
        }
        $validator = Validator::make($request->all(), [
            // rules...
        ]);

        if ($validator->fails()) {
            return back()->withInput(['old_image' => $path]);
        }
        $validatedData = $validator->validated();
        return redirect('/dashboard/posts')->with('success', 'New post has been added!' . ' ' . $product->title);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $post)
    {
        return view('admin.page.show', [
            'post' => $post,
            // 'post' => Product::where('slug', $post->slug)->firstOrFail()
            // 'post' => Product::where('slug', $post->slug)->firstOrFail()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $post)
    {
        return view('admin.page.edit', [
            'post' => $post,
            'categories' => Category::all(),
            'platforms' => Platform::all(),
            'galleryImages' => $post->images, // Assuming you have a relationship set up for images
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $post)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'feature' => 'required',
            'aditional' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Tidak wajib saat edit
            'date' => 'required|date',
            'gallery' => 'array|max:4',
            'gallery.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ];

        $messages = [
            'gallery.max' => 'Maksimal 4 gambar untuk galeri.',
            'gallery.*.image' => 'Semua file di gallery harus berupa gambar.',
            'gallery.*.mimes' => 'Format gambar hanya boleh jpg, jpeg, atau png.',
            'gallery.*.max' => 'Ukuran gambar di gallery maksimal 2MB.',
        ];

        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:products,slug';
        } else {
            $rules['slug'] = 'required';
        }

        $validatedData = $request->validate($rules, $messages);
        $validatedData['user_id'] = Auth::user()->id;

        // Handle image upload
        if ($request->file('image')) {
            // Delete old image if exists
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
            $validatedData['image'] = $request->file('image')->store('', 'public');
        } else {
            unset($validatedData['image']);
        }

        // Generate excerpt from description
        $plainText = strip_tags($request->description); // Simplified cleaning
        $plainText = strip_tags($request->feature); // Simplified cleaning
        $plainText = strip_tags($request->aditional); // Simplified cleaning
        $validatedData['excerpt'] = Str::limit($plainText, 200);

        // Update the post
        if (!$post->update($validatedData)) {
            return back()->with('error', 'Update gagal!');
        }


        // Handle platforms
        if ($request->has('platforms')) {
            $post->platforms()->sync($request->platforms);
        }

        // Handle gallery images
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $galleryImage) {
                $galleryPath = $galleryImage->store('', 'public');
                ProductImage::create([
                    'product_id' => $post->id,
                    'image_url' => $galleryPath,
                ]);
            }
        }

        return redirect('/dashboard/posts')->with('success', 'Post has been updated! ' . $post->title);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $post)
    {
        Product::destroy($post->id);
        return redirect('/dashboard/posts')->with('success', 'Delete post successfully!' . ' ' . $post->title);
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    private function cleanTrixContent($html)
    {
        $html = str_replace('&nbsp;', ' ', $html);

        $dom = new \DOMDocument();
        @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

        $xpath = new \DOMXPath($dom);

        foreach ($xpath->query('//p | //div') as $node) {
            $node->parentNode->insertBefore($dom->createTextNode("\n\n"), $node->nextSibling);
        }

        foreach ($xpath->query('//br') as $node) {
            $node->parentNode->replaceChild($dom->createTextNode("\n"), $node);
        }

        $text = $dom->textContent;
        $text = trim(preg_replace("/[\r\n]+/", "\n", $text));

        return $text;
    }


    public function deleteGalleryImage(ProductImage $image)
    {
        // Hapus file dari storage
        if ($image->image_url && Storage::disk('public')->exists($image->image_url)) {
            Storage::disk('public')->delete($image->image_url);
        }
        // Hapus record dari database
        $image->delete();

        return back()->with('success', 'Gallery image deleted!');
    }
    public function deleteProductImage(Product $post)
    {
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
            $post->image = null;
            $post->save();
        }
        return back()->with('success', 'Product image deleted!');
    }
}
