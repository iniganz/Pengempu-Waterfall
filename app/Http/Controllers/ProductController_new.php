<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController_new extends Controller
{
    /**
     * Display Pengempu Waterfall product page (Public)
     */
    public function show()
    {
        try {
            // Get the main product (Pengempu Waterfall)
            $product = Product::with('images')
                ->where('slug', 'pengempu-waterfall')
                ->firstOrFail();

            return view('publik.page.product', compact('product'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error loading product: ' . $e->getMessage());
        }
    }

    /**
     * Display all products (Public - for gallery page)
     */
    public function index()
    {
        try {
            $products = Product::with('images', 'category')->paginate(12);
            return view('publik.page.all2', compact('products'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error loading products: ' . $e->getMessage());
        }
    }
}
