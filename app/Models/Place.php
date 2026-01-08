<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'rating',
        'address',
        'lat',
        'lng',
        'map_embed',
        'image'
    ];
}
