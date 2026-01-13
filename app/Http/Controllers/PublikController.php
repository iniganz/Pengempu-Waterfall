<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PublikController extends Controller
{
 public function index()
{
    return view('publik.page.home', [
        'title' => 'Index',
    ]);
}
    public function contact()
    {
        return view('publik.page.contact', [
            'title' => 'Contact',
        ]);
    }


}

