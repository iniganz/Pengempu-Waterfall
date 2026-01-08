<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PublikController extends Controller
{
 public function index()
{
    $totalProducts = Product::count();
    return view('publik.page.home', [
        'totalProducts' => $totalProducts,
        'title' => 'Index',
    ]);
}


    public function about()
    {
        return view('publik.page.about', [
            'title' => 'About',
        ]);
    }
    public function service()
    {
        return view('publik.page.service', [
            'title' => 'Service',
        ]);
    }
    public function portfolioDetail()
    {
        return view('publik.page.portfolio', [
            'title' => 'Portfolio',
        ]);
    }
    public function portfolioAll()
    {
        return view('publik.page.all', [
            'title' => 'All',
        ]);
    }
    public function portfolioArt()
    {
        // Ambil data produk dengan kategori Art
        $products = Product::where('category', 'like', '%Art%')->get();

        // Kirim data ke view
        return view('publik.page.art', compact('products'));
    }
    public function portfolioPc()
    {
        // Ambil data produk dengan kategori PC
        $products = Product::where('category', 'like', '%PC%')->get();

        // Kirim data ke view
        return view('publik.page.pc', compact('products'));
    }
    public function portfolioHp()
    {
        // Ambil data produk dengan kategori Mobile Games
        $products = Product::where('category', 'like', '%Mobile%')->get();

        // Kirim data ke view
        return view('publik.page.hp', compact('products'));
    }
    public function contact()
    {
        return view('publik.page.contact', [
            'title' => 'Contact',
        ]);
    }


}

