<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\Program\StreamsController as AdminProgramStreamsController;
use App\Http\Controllers\Admin\Program\ExculController as AdminProgramExculController;
use App\Http\Controllers\Admin\Program\AchievementController as AdminProgramAchievementController;
use App\Http\Controllers\Admin\Program\UnggulanController as AdminProgramUnggulanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
Route::prefix('admin')->middleware(['role:admin'])->name('admin.')->group(function() {

    // dashboard
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // gallery
    Route::resource('gallery', AdminGalleryController::class);
    Route::post('gallery-image/{gallery}', [AdminGalleryController::class, 'imageStore'])->name('gallery.image.store');
    Route::delete('gallery-image/{gallery}', [AdminGalleryController::class, 'imageDestroy'])->name('gallery.image.destroy');

    // streams
    Route::resource('streams', AdminProgramStreamsController::class);
    Route::post('streams-image/{streams}', [AdminProgramStreamsController::class, 'imageStore'])->name('streams.image.store');
    Route::delete('streams-image/{streams}', [AdminProgramStreamsController::class, 'imageDestroy'])->name('streams.image.destroy');

    // excul
    Route::resource('excul', AdminProgramExculController::class);
    Route::post('excul-image/{excul}', [AdminProgramExculController::class, 'imageStore'])->name('excul.image.store');
    Route::delete('excul-image/{excul}', [AdminProgramExculController::class, 'imageDestroy'])->name('excul.image.destroy');

    // Achievement
    Route::resource('achievement', AdminProgramAchievementController::class);
    Route::post('achievement-image/{achievement}', [AdminProgramAchievementController::class, 'imageStore'])->name('achievement.image.store');
    Route::delete('achievement-image/{achievement}', [AdminProgramAchievementController::class, 'imageDestroy'])->name('achievement.image.destroy');

    // Program Unggulan
    Route::resource('unggulan', AdminProgramUnggulanController::class);
    Route::post('unggulan-image/{unggulan}', [AdminProgramUnggulanController::class, 'imageStore'])->name('unggulan.image.store');
    Route::delete('unggulan-image/{unggulan}', [AdminProgramUnggulanController::class, 'imageDestroy'])->name('unggulan.image.destroy');

});



require __DIR__.'/auth.php';
