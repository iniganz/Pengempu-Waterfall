<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductAdminController extends Controller
{
    /**
     * Display all products in dashboard
     */
    public function index()
    {
        try {
            $products = Product::with('images', 'category')
                ->latest()
                ->paginate(12);

            return view('dashboard.products.index', compact('products'));
        } catch (\Exception $e) {
            Log::error('ProductAdminController@index: ' . $e->getMessage());
            return back()->with('error', 'Error loading products: ' . $e->getMessage());
        }
    }

    /**
     * Show product detail page
     */
    public function show(Product $product)
    {
        try {
            $product->load('images', 'category', 'platforms');

            return view('dashboard.products.detail', compact('product'));
        } catch (\Exception $e) {
            Log::error('ProductAdminController@show: ' . $e->getMessage());
            return back()->with('error', 'Error loading product: ' . $e->getMessage());
        }
    }

    /**
     * Show create product form
     */
    public function create()
    {
        try {
            $categories = Category::all();
            $platforms = Platform::all();

            return view('dashboard.products.create', compact('categories', 'platforms'));
        } catch (\Exception $e) {
            Log::error('ProductAdminController@create: ' . $e->getMessage());
            return back()->with('error', 'Error loading form: ' . $e->getMessage());
        }
    }

    /**
     * Store product to database
     */
    public function store(Request $request)
    {
        try {
            // Validation
            $validated = $request->validate([
                'title' => 'required|string|max:255|unique:products',
                'category_id' => 'required|integer|exists:categories,id',
                'description' => 'required|string|min:10',
                'feature' => 'nullable|string',
                'aditional' => 'nullable|string',
                'additional_info' => 'nullable|string',
                'date' => 'nullable|date',
                'platform' => 'nullable|string|max:255',
                'images' => 'nullable|array|max:10',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'platforms' => 'nullable|array',
                'platforms.*' => 'integer|exists:platforms,id',
            ]);

            // Start transaction
            DB::beginTransaction();

            // Create product
            $product = Product::create($validated);

            // Handle image uploads
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    try {
                        $path = $image->store('products', 'public');
                        ProductImage::create([
                            'product_id' => $product->id,
                            'image_url' => $path,
                        ]);
                    } catch (\Exception $e) {
                        Log::error('Image upload failed: ' . $e->getMessage());
                        throw new \Exception('Failed to upload image: ' . $image->getClientOriginalName());
                    }
                }
            }

            // Attach platforms
            if (!empty($validated['platforms'])) {
                $product->platforms()->attach($validated['platforms']);
            }

            DB::commit();

            return redirect()->route('admin.products.show', $product)
                           ->with('success', 'Product created successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('ProductAdminController@store: ' . $e->getMessage());
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Show edit product form
     */
    public function edit(Product $product)
    {
        try {
            $product->load('images', 'category', 'platforms');
            $categories = Category::all();
            $platforms = Platform::all();

            return view('dashboard.products.edit', compact('product', 'categories', 'platforms'));
        } catch (\Exception $e) {
            Log::error('ProductAdminController@edit: ' . $e->getMessage());
            return back()->with('error', 'Error loading form: ' . $e->getMessage());
        }
    }

    /**
     * Update product
     */
    public function update(Request $request, Product $product)
    {
        try {
            // Validation
            $validated = $request->validate([
                'title' => 'required|string|max:255|unique:products,title,' . $product->id,
                'category_id' => 'required|integer|exists:categories,id',
                'description' => 'required|string|min:10',
                'feature' => 'nullable|string',
                'aditional' => 'nullable|string',
                'additional_info' => 'nullable|string',
                'date' => 'nullable|date',
                'platform' => 'nullable|string|max:255',
                'images' => 'nullable|array|max:10',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'platforms' => 'nullable|array',
                'platforms.*' => 'integer|exists:platforms,id',
            ]);

            // Start transaction
            DB::beginTransaction();

            // Update product
            $product->update($validated);

            // Handle new image uploads
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    try {
                        $path = $image->store('products', 'public');
                        ProductImage::create([
                            'product_id' => $product->id,
                            'image_url' => $path,
                        ]);
                    } catch (\Exception $e) {
                        Log::error('Image upload failed: ' . $e->getMessage());
                        throw new \Exception('Failed to upload image: ' . $image->getClientOriginalName());
                    }
                }
            }

            // Update platforms
            $product->platforms()->sync($validated['platforms'] ?? []);

            DB::commit();

            return redirect()->route('admin.products.show', $product)
                           ->with('success', 'Product updated successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('ProductAdminController@update: ' . $e->getMessage());
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Delete product
     */
    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();

            // Delete associated images from storage
            foreach ($product->images as $image) {
                try {
                    if (Storage::disk('public')->exists($image->image_url)) {
                        Storage::disk('public')->delete($image->image_url);
                    }
                } catch (\Exception $e) {
                    Log::warning('Failed to delete image file: ' . $e->getMessage());
                }
                $image->delete();
            }

            // Detach platforms
            $product->platforms()->detach();

            // Delete product
            $product->delete();

            DB::commit();

            return redirect()->route('admin.products.index')
                           ->with('success', 'Product deleted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('ProductAdminController@destroy: ' . $e->getMessage());
            return back()->with('error', 'Error deleting product: ' . $e->getMessage());
        }
    }
}
