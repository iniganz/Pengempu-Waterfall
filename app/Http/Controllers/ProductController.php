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
    public function show($slug = null)
    {
        try {
            $product = null;

            // If slug provided, try to get that product
            if ($slug) {
                $product = Product::with('images', 'category', 'platforms')
                    ->where('slug', $slug)
                    ->first();
            }

            // If not found, try default slug 'pengempu-waterfall'
            if (!$product) {
                $product = Product::with('images', 'category', 'platforms')
                    ->where('slug', 'pengempu-waterfall')
                    ->first();
            }

            // If still not found, get the first published product
            if (!$product) {
                $product = Product::with('images', 'category', 'platforms')
                    ->where('published', true)
                    ->first();
            }

            // If still not found, throw error
            if (!$product) {
                return back()->with('error', 'Produk tidak ditemukan');
            }

            return view('publik.page.product', compact('product'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error loading product: ' . $e->getMessage());
        }
    }











}
