<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Show booking page for a product.
     */
    public function index(Product $product)
    {
        return view('publik.booking.index', compact('product'));
    }

    /**
     * Handle booking submit (identity + qty + date).
     */
    public function store(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['required', 'string', 'max:30'],
            'reserve_date' => ['required', 'date'],
            'qty' => ['required', 'integer', 'min:1'],
            'total' => ['required', 'integer', 'min:0'],
        ]);

        // Placeholder: store to session / next step
        session()->flash('booking_success', 'Data booking berhasil disimpan. Lanjut ke tahap berikutnya.');
        session()->flash('booking_data', $data);

        return redirect()->route('booking.show', $product);
    }
}
