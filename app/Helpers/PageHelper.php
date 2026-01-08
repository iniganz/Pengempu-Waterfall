<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;

class PageHelper
{
    /**
     * Get the appropriate wave style class based on the current route
     * @return string
     */
    public static function getWaveClass()
    {
        $currentRoute = Route::currentRouteName();

        $waveClasses = [
            'home' => 'w-home',
            'galery' => 'w-default',
            'contact' => 'w-default',
            'service' => 'w-home',
            'about' => 'w-home',
            'default' => 'w-default',
            'product' => 'w-third',
            'testimonial' => 'w-second',
            'testimonial.form' => 'w-second',
            'gallery-post.create' => 'w-second',
            'explore-sekitar' => 'w-default',

        ];

        return $waveClasses[$currentRoute] ?? $waveClasses['default'];
    }

    /**
     * Check if current page is home page
     * @return bool
     */
    public static function isHome()
    {
        return Route::currentRouteName() === 'home';
    }
}
