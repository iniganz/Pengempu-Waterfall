<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestimonialAdminController extends Controller
{
     public function index()
    {
        $testimonials = Testimonial::latest()->get();

        return view('dashboard.testimonials.index', compact('testimonials'));
    }

    public function toggle($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update([
            'is_active' => ! $testimonial->is_active
        ]);

        return back()->with('success', 'Status testimonial diperbarui');
    }

    public function destroy($id)
    {
        Testimonial::findOrFail($id)->delete();

        return back()->with('success', 'Testimonial dihapus');
    }
}
