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
        // gunakan slug bila ada, fallback ke "pengempu-waterfall"
        $slug = $product ?? 'pengempu-waterfall';

        $product = Product::with('images', 'category', 'platforms')
            ->where('slug', $slug)
            ->first();

        if (!$product) {
            // Jika data belum ada (mis. seeder belum dijalankan), tampilkan 404 jelas
            abort(404, 'Product tidak ditemukan. Jalankan seeder atau buat produk dengan slug: ' . $slug);
        }

        return view('publik.page.product', compact('product'));
    }










}
