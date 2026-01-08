<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function index()
    {
        return view('explore.index', [
            'places' => Place::all()
        ]);
    }

    public function show($slug)
    {
        return view('explore.show', [
            'place' => Place::where('slug', $slug)->firstOrFail()
        ]);
    }
}
