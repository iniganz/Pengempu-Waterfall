<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GalleryPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'caption',
        'image_path',
        'image_data',
        'status',
    ];
}
