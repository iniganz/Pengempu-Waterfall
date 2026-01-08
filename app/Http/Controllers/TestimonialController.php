<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::where('is_active', true)
            ->latest()
            ->get();

        return view('publik.page.home', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'description' => 'required|max:1000',
        ]);

        Testimonial::create([
            'name' => $request->name,
            'rating' => $request->rating,
            'description' => $request->description,
            'is_active' => false // menunggu approval
        ]);

        return redirect()
            ->route('testimonial.form')
            ->with('success', 'Terima kasih! Testimonial Anda akan ditampilkan setelah diverifikasi.');
    }
}
