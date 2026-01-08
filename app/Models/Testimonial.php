<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Testimonial.php
class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'rating',
        'description',
        'is_active'
    ];
}
