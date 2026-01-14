<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Testimonial;

class PublikController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::where('is_active', true)
            ->latest()
            ->get();

        return view('publik.page.home', [
            'title' => 'Index',
            'testimonials' => $testimonials,
        ]);
    }
    public function contact()
    {
        return view('publik.page.contact', [
            'title' => 'Contact',
        ]);
    }


}

