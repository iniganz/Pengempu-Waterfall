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
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = $this->generateUniqueSlug($request->name);

        // Upload image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('places', 'public');
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
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = $this->generateUniqueSlug($request->name);

        // Ganti image lama
        if ($request->hasFile('image')) {
            if ($place->image && Storage::disk('public')->exists($place->image)) {
                Storage::disk('public')->delete($place->image);
            }

            $data['image'] = $request->file('image')
                ->store('places', 'public');
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
        if ($place->image && Storage::disk('public')->exists($place->image)) {
            Storage::disk('public')->delete($place->image);
        }

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
