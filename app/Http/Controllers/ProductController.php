<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display all products (Public)
     */
    public function index()
    {
        try {
            $products = Product::with('images', 'category')
                ->where('published', true)
                ->paginate(12);

            return view('publik.page.all2', compact('products'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error loading products: ' . $e->getMessage());
        }
    }

    /**
     * Display product detail (Public) - Pengempu Waterfall
     */
    public function show($product = null)
    {
        try {
            // If a slug is provided (e.g. route('product', ['product' => 'pengempu-waterfall']))
            // use it; otherwise fall back to the Pengempu Waterfall product
            $slug = $product ?? 'pengempu-waterfall';

            $product = Product::with('images', 'category', 'platforms')
                ->where('slug', $slug)
                ->firstOrFail();

            return view('publik.page.product', compact('product'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error loading product: ' . $e->getMessage());
        }
    }










}
