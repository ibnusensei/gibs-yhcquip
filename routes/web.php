<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// administrator
Route::prefix('admin')->middleware(['role:admin'])->name('admin.')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('gallery', AdminGalleryController::class);

    Route::post('gallery-image/{gallery}', [AdminGalleryController::class, 'imageStore'])->name('gallery.image.store');
    Route::delete('gallery-image/{gallery}', [AdminGalleryController::class, 'imageDestroy'])->name('gallery.image.destroy');

    Route::resource('event', EventController::class);
    Route::post('image', [EventController::class, 'imageStore'])->name('event.image.store');
});

require __DIR__ . '/auth.php';
