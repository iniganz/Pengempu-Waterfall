<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

use App\Http\Controllers\KontakController;
use App\Http\Controllers\PublikController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\GalleryPostController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\Admin\PostAdminController;
use App\Http\Controllers\Admin\GalleryAdminController;
use App\Http\Controllers\Admin\TestimonialAdminController;
use App\Http\Controllers\Admin\SystemHealthController;


// Only expose storage:link locally for safety
if (app()->environment('local')) {
    Route::get('/storage-link', function () {
        Artisan::call('storage:link');
        return 'Storage link successfully';
    });
}

// Clear all caches (temp route for Railway)
Route::get('/clear-all-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return 'All caches cleared: cache, config, view, route';
});

// Run migrations (temp route for Railway)
Route::get('/run-migrations', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        return 'Migrations completed: ' . Artisan::output();
    } catch (\Exception $e) {
        return 'Migration error: ' . $e->getMessage();
    }
});

// Debug product images data
Route::get('/debug-product-images', function () {
    $images = \App\Models\ProductImage::with('product')->get();
    $result = [];
    foreach ($images as $img) {
        $result[] = [
            'id' => $img->id,
            'product' => $img->product->title ?? 'N/A',
            'image_url' => $img->image_url,
            'image_data_exists' => !empty($img->image_data),
            'image_data_length' => $img->image_data ? strlen($img->image_data) : 0,
            'image_data_starts_with' => $img->image_data ? substr($img->image_data, 0, 50) : null,
        ];
    }
    return response()->json($result, 200, [], JSON_PRETTY_PRINT);
});

// Debug places data
Route::get('/debug-places', function () {
    $places = \App\Models\Place::all();
    $result = [];
    foreach ($places as $place) {
        $result[] = [
            'id' => $place->id,
            'name' => $place->name,
            'image' => $place->image,
            'image_data_exists' => !empty($place->image_data),
            'image_data_length' => $place->image_data ? strlen($place->image_data) : 0,
            'image_data_starts_with' => $place->image_data ? substr($place->image_data, 0, 50) : null,
        ];
    }
    return response()->json($result, 200, [], JSON_PRETTY_PRINT);
});

// Debug gallery posts data
Route::get('/debug-gallery-posts', function () {
    $posts = \App\Models\GalleryPost::latest()->take(10)->get();
    $result = [];
    foreach ($posts as $post) {
        $result[] = [
            'id' => $post->id,
            'name' => $post->name,
            'image_path' => $post->image_path,
            'image_data_exists' => !empty($post->image_data),
            'image_data_length' => $post->image_data ? strlen($post->image_data) : 0,
            'image_data_starts_with' => $post->image_data ? substr($post->image_data, 0, 50) : null,
            'status' => $post->status,
        ];
    }
    return response()->json($result, 200, [], JSON_PRETTY_PRINT);
});

// Email diagnostic route (PRODUCTION DEBUG - REMOVE AFTER FIXING)
Route::get('/debug-ticket-email', function () {
    $results = [];

    // 1. Check environment
    $results['environment'] = [
        'MAIL_MAILER' => env('MAIL_MAILER', 'NOT SET'),
        'MAIL_FROM_ADDRESS' => config('mail.from.address', 'NOT SET'),
        'MAIL_FROM_NAME' => config('mail.from.name', 'NOT SET'),
        'RESEND_API_KEY_EXISTS' => env('RESEND_API_KEY') ? 'YES (key: ' . substr(env('RESEND_API_KEY'), 0, 10) . '...)' : 'NO',
    ];

    // 2. Find test order
    $order = \App\Models\Order::where('payment_status', 'settlement')
        ->whereNotNull('email')
        ->with('ticket')
        ->first();

    if (!$order) {
        $results['error'] = 'No settlement order found. Pay for a ticket first.';
        return response()->json($results, 500);
    }

    $results['order'] = [
        'id' => $order->id,
        'order_id' => $order->order_id,
        'email' => $order->email,
        'has_ticket' => $order->ticket ? 'YES' : 'NO',
    ];

    // 3. Create ticket if not exists
    if (!$order->ticket) {
        $ticket = \App\Models\Ticket::create([
            'order_id' => $order->id,
            'ticket_code' => 'TKT-' . strtoupper(Str::random(8)),
            'qr_token' => (string) Str::uuid(),
        ]);
        $results['ticket_created'] = $ticket->ticket_code;
    } else {
        $ticket = $order->ticket;
        $results['ticket_code'] = $ticket->ticket_code;
    }

    // 4. Render email view
    try {
        $html = View::make('mail.ticket', [
            'order' => $order,
            'ticket' => $ticket,
            'qrUrl' => route('ticket.verify', $ticket->qr_token),
        ])->render();

        $results['view_rendered'] = 'YES (' . strlen($html) . ' chars)';
    } catch (\Throwable $e) {
        $results['view_error'] = $e->getMessage();
        return response()->json($results, 500);
    }

    // 5. Send via Resend
    try {
        if (env('MAIL_MAILER') === 'resend' || env('RESEND_API_KEY')) {
            $response = \App\Services\ResendMailer::send(
                from: sprintf('%s <%s>', config('mail.from.name', 'Admin'), config('mail.from.address', 'onboarding@resend.dev')),
                to: $order->email,
                subject: 'DEBUG TEST - Tiket Resmi - ' . $order->order_id,
                html: $html
            );

            $results['resend_response'] = $response;
            $results['success'] = true;
            $results['message'] = 'Email sent successfully! Check inbox: ' . $order->email;
        } else {
            $results['error'] = 'Resend not configured (env check failed)';
            return response()->json($results, 500);
        }
    } catch (\Throwable $e) {
        $results['send_error'] = [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ];
        return response()->json($results, 500);
    }

    return response()->json($results, 200);
})->middleware('auth');

Route::get('/', [PublikController::class, 'index'])->name('home');
// Route::get('/explore-sekitar', [PublikController::class, 'explore-sekitar'])->name('explore-sekitar');
Route::get('/contact', [PublikController::class, 'contact'])->name('contact');
Route::post('/contact/send', [KontakController::class, 'send'])->name('contact.send');


Route::get('/galery', [GalleryPostController::class, 'publicGallery'])->name('galery');
// Product detail; accept optional slug (for backwards compatibility some links send a 'product' param)
Route::get('/product/{product?}', [ProductController::class, 'show'])->name('product');
// Products list
Route::get('/products', [ProductController::class, 'index'])->name('products');

Route::get('/explore-sekitar', [ExploreController::class, 'index'])->name('explore-sekitar');
Route::get('/explore-sekitar/{slug}', [ExploreController::class, 'show']);

// Testimonial landing & form
Route::post('/testimonial', [TestimonialController::class, 'store'])->name('testimonial.store');
Route::get('/testimonial', function () {
    return view('publik.page.testimonial');
})->name('testimonial.form');

Route::get('/booking/{product}', [BookingController::class, 'index'])->name('booking.show');
Route::post('/booking/{product}', [BookingController::class, 'store'])->name('booking.store');
Route::post('/booking/{product}/snap-token', [BookingController::class, 'snapToken'])->name('booking.snap-token');
Route::get('/booking/{product}/payment', [BookingController::class, 'payment'])->name('booking.payment');
Route::get('/booking/{product}/finish', [BookingController::class, 'finish'])->name('booking.finish');


Route::post('/midtrans/webhook', [MidtransController::class, 'handle']);

// Public route - untuk pengunjung scan QR
Route::get('/ticket/verify/{token}', [TicketController::class, 'verify'])
    ->name('ticket.verify');

// Protected route - untuk pengelola validate ticket
Route::middleware('auth')->get('/ticket/validate/{token}', [TicketController::class, 'validate'])
    ->name('ticket.validate');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Ticket Scanning - untuk pengelola
    Route::get('/ticket/scan', function() {
        return view('publik.ticket.scan-dashboard');
    })->name('ticket.scan');

    // Post Pengunjung Routes
    Route::get('/dashboard/post', [GalleryPostController::class, 'adminIndex'])
        ->name('dashboard.post');
    Route::patch('/dashboard/post/{id}/approve', [PostAdminController::class, 'approve'])
        ->name('dashboard.post.approve');
    Route::patch('/dashboard/post/{id}/reject', [PostAdminController::class, 'reject'])
        ->name('dashboard.post.reject');
    Route::delete('/dashboard/post/{id}', [PostAdminController::class, 'destroy'])
        ->name('dashboard.post.destroy');

    // Gallery Management Routes (only for Pengempu Waterfall)
    Route::get('/dashboard/gallery', [GalleryAdminController::class, 'index'])
        ->name('dashboard.gallery');
    Route::post('/dashboard/gallery/upload', [GalleryAdminController::class, 'upload'])
        ->name('admin.gallery.upload');
    Route::patch('/dashboard/gallery/{productImage}/set-main', [GalleryAdminController::class, 'setMain'])
        ->name('admin.gallery.setMain');
    Route::delete('/dashboard/gallery/{productImage}', [GalleryAdminController::class, 'deleteImage'])
        ->name('admin.gallery.delete');

    // Testimonials Routes
    Route::get('/dashboard/testimonials', [TestimonialAdminController::class, 'index'])
        ->name('dashboard.testimonials');

    Route::patch('/dashboard/testimonials/{id}', [TestimonialAdminController::class, 'toggle'])
        ->name('dashboard.testimonials.toggle');

    Route::delete('/dashboard/testimonials/{id}', [TestimonialAdminController::class, 'destroy'])
        ->name('dashboard.testimonials.delete');

    // Place Management Resource Route
    Route::resource('places', PlaceController::class)->names('dashboard.places');

    // Orders monitor
    Route::get('/dashboard/orders', [OrderAdminController::class, 'index'])
        ->name('dashboard.orders.index');
    Route::get('/dashboard/orders/{order}', [OrderAdminController::class, 'show'])
        ->name('dashboard.orders.show');
    Route::delete('/dashboard/orders/{order}', [OrderAdminController::class, 'destroy'])
        ->name('dashboard.orders.destroy');
    Route::post('/dashboard/orders/{order}/resend-ticket', [OrderAdminController::class, 'resendTicket'])
        ->name('dashboard.orders.resendTicket');

    // Health checks (authenticated)
    Route::get('/dashboard/health/email', [SystemHealthController::class, 'email'])
        ->name('dashboard.health.email');
    Route::get('/dashboard/health/storage', [SystemHealthController::class, 'storage'])
        ->name('dashboard.health.storage');
});




Route::get('/post-foto', [GalleryPostController::class, 'create'])->name('gallery-post.create');
Route::post('/post-foto', [GalleryPostController::class, 'store'])->name('gallery-post.store');

require __DIR__ . '/auth.php';
