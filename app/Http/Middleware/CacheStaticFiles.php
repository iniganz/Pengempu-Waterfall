<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheStaticFiles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only cache static files (images, CSS, JS)
        $path = $request->path();

        if (
            str_starts_with($path, 'images/') ||
            str_starts_with($path, 'css/') ||
            str_starts_with($path, 'js/') ||
            str_starts_with($path, 'assets/') ||
            str_starts_with($path, 'build/')
        ) {
            // Cache for 1 year (images rarely change)
            $response->header('Cache-Control', 'public, max-age=31536000, immutable');
            $response->header('Expires', gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');
        }

        return $response;
    }
}
