





<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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


Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage link successfully';
});

Route::get('/', [PublikController::class, 'index'])->name('home');
// Route::get('/explore-sekitar', [PublikController::class, 'explore-sekitar'])->name('explore-sekitar');
Route::get('/contact', [PublikController::class, 'contact'])->name('contact');
Route::post('/contact/send', [KontakController::class, 'send'])->name('contact.send');


Route::get('/galery', [GalleryPostController::class, 'publicGallery'])->name('galery');
Route::get('/product', [ProductController::class, 'show'])->name('product');

Route::get('/explore-sekitar', [ExploreController::class, 'index'])->name('explore-sekitar');
Route::get('/explore-sekitar/{slug}', [ExploreController::class, 'show']);

Route::get('/', [TestimonialController::class, 'index'])->name('home');
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
});




Route::get('/post-foto', [GalleryPostController::class, 'create'])->name('gallery-post.create');
Route::post('/post-foto', [GalleryPostController::class, 'store'])->name('gallery-post.store');

require __DIR__ . '/auth.php';
