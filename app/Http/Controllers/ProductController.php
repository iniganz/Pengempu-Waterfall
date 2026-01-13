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
public function show($id = null)
{
    if ($id) {
        $product = Product::with('images','category','platforms')->findOrFail($id);
    } else {
        $product = Product::where('published', true)->firstOrFail();
    }

    return view('publik.page.product', compact('product'));
}












}
