<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    /**
     * Delete a product image
     */
    public function destroy(ProductImage $productImage)
    {
        // Delete file from storage
        if (Storage::disk('public')->exists($productImage->image_url)) {
            Storage::disk('public')->delete($productImage->image_url);
        }

        // Delete database record
        $productImage->delete();

        return back()->with('success', 'Image deleted successfully.');
    }
}
