<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $places = Place::latest()->paginate(10);
        return view('dashboard.places.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.places.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|in:wisata,kuliner,umkm',
            'rating'      => 'required|numeric|min:0|max:5',
            'description' => 'required',
            'address'     => 'required',
            'lat'         => 'required|numeric',
            'lng'         => 'required|numeric',
            'map_embed'   => 'nullable',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $data = $request->all();
        $data['slug'] = $this->generateUniqueSlug($request->name);

        // Upload image as base64 to database (Railway ephemeral filesystem workaround)
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $mimeType = $file->getMimeType();
            $base64Image = 'data:' . $mimeType . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
            $data['image'] = 'database'; // Marker
            $data['image_data'] = $base64Image;
        }

        Place::create($data);

        return redirect()
            ->route('dashboard.places.index')
            ->with('success', 'Tempat berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place)
    {
        return view('dashboard.places.edit', compact('place'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Place $place)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|in:wisata,kuliner,umkm',
            'rating'      => 'required|numeric|min:0|max:5',
            'description' => 'required',
            'address'     => 'required',
            'lat'         => 'required|numeric',
            'lng'         => 'required|numeric',
            'map_embed'   => 'nullable',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $data = $request->all();
        $data['slug'] = $this->generateUniqueSlug($request->name);

        // Ganti image dengan base64 baru
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $mimeType = $file->getMimeType();
            $base64Image = 'data:' . $mimeType . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
            $data['image'] = 'database'; // Marker
            $data['image_data'] = $base64Image;
        }

        $place->update($data);

        return redirect()
            ->route('dashboard.places.index')
            ->with('success', 'Tempat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        $place->delete();

        return redirect()
            ->route('dashboard.places.index')
            ->with('success', 'Tempat berhasil dihapus.');
    }

    private function generateUniqueSlug($name)
{
    $slug = Str::slug($name);
    $originalSlug = $slug;
    $count = 1;

    while (Place::where('slug', $slug)->exists()) {
        $slug = $originalSlug . '-' . $count;
        $count++;
    }

    return $slug;
}

}
