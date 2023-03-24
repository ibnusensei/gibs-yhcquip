<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\AcademicController as AdminAcademicController;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\LeaderController as AdminLeaderController;
use App\Http\Controllers\Admin\CampusTourController as AdminCampustTourController;
use App\Http\Controllers\Admin\StaffController as AdminStaffController;
use App\Http\Controllers\Admin\CareerController as AdminCareerController;
use App\Http\Controllers\Admin\JobController as AdminJobController;
use App\Http\Controllers\Admin\Program\StreamsController as AdminProgramStreamsController;
use App\Http\Controllers\Admin\Program\ExculController as AdminProgramExculController;
use App\Http\Controllers\Admin\Program\AchievementController as AdminProgramAchievementController;
use App\Http\Controllers\Admin\Program\UnggulanController as AdminProgramUnggulanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\NewsCategoryController as AdminNewsCategoryController;

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
    
    // article
    Route::resource('article', AdminArticleController::class);
    Route::get('article-category', [AdminArticleController::class, 'category'])->name('category');
    Route::get('article-comment', [AdminArticleController::class, 'category'])->name('comment');

    // academic
    Route::resource('academic', AdminAcademicController::class);
    Route::post('academic-image/{academic}', [AdminAcademicController::class, 'imageStore'])->name('academic.image.store');
    Route::delete('academic-image/{academic}', [AdminAcademicController::class, 'imageDestroy'])->name('academic.image.destroy');

    // gallery
    Route::resource('gallery', AdminGalleryController::class);
    Route::post('gallery-image/{gallery}', [AdminGalleryController::class, 'imageStore'])->name('gallery.image.store');
    Route::delete('gallery-image/{gallery}', [AdminGalleryController::class, 'imageDestroy'])->name('gallery.image.destroy');

    // News
    Route::resource('news', AdminNewsController::class);
    Route::resource('news-category', AdminNewsCategoryController::class);
    Route::post('news-publis', [AdminNewsController::class, 'publis'])->name('publis.news');
    Route::post('news-publis-delete/{id}', [AdminNewsController::class, 'destroy'])->name('delete.news');
    Route::get('news-search', [AdminNewsController::class, 'search'])->name('search.news');
    Route::get('news-ajax', [AdminNewsController::class, 'ajax'])->name('ajax.news');

    // About
    Route::resource('about', AdminAboutController::class);
    Route::post('about-image/{about}', [AdminAboutController::class, 'imageStore'])->name('about.image.store');
    Route::delete('about-image/{about}', [AdminAboutController::class, 'imageDestroy'])->name('about.image.destroy');

    // leader
    Route::resource('leader', AdminLeaderController::class);
    Route::post('leader-image/{leader}', [AdminLeaderController::class, 'imageStore'])->name('leader.image.store');
    Route::delete('leader-image/{leader}', [AdminLeaderController::class, 'imageDestroy'])->name('leader.image.destroy');

    //Camputours
    Route::resource('campustour', AdminCampustTourController::class);

    //Staff
    Route::resource('staff', AdminStaffController::class);

    // career
    Route::resource('career', AdminCareerController::class);
    Route::post('career-publish/{career}', [AdminCareerController::class, 'publish'])->name('career.publish');

    // job
    Route::resource('job', AdminJobController::class);
    Route::post('job-publish/{job}', [AdminJobController::class, 'publish'])->name('job.publish');


    // event
    Route::resource('event', EventController::class);
    Route::post('image', [EventController::class, 'imageStore'])->name('event.image.store');
    // streams
    Route::resource('streams', AdminProgramStreamsController::class);
    Route::post('streams-image/{streams}', [AdminProgramStreamsController::class, 'imageStore'])->name('streams.image.store');
    Route::delete('streams-image/{streams}', [AdminProgramStreamsController::class, 'imageDestroy'])->name('streams.image.destroy');
    Route::post('streams-publish/{streams}', [AdminProgramStreamsController::class, 'publish'])->name('streams.publish');

    // excul
    Route::resource('excul', AdminProgramExculController::class);
    Route::post('excul-image/{excul}', [AdminProgramExculController::class, 'imageStore'])->name('excul.image.store');
    Route::delete('excul-image/{excul}', [AdminProgramExculController::class, 'imageDestroy'])->name('excul.image.destroy');
    Route::post('excul-publish/{excul}', [AdminProgramExculController::class, 'publish'])->name('excul.publish');

    // Achievement
    Route::resource('achievement', AdminProgramAchievementController::class);
    // Route::post('/achievement/update/{id}', [AdminProgramAchievementController::class, 'update'])->name('achievement.update');
    Route::post('achievement-image/{achievement}', [AdminProgramAchievementController::class, 'imageStore'])->name('achievement.image.store');
    Route::delete('achievement-image/{achievement}', [AdminProgramAchievementController::class, 'imageDestroy'])->name('achievement.image.destroy');
    Route::post('achievement-publish/{achievement}', [AdminProgramAchievementController::class, 'publish'])->name('achievement.publish');

    // Program Unggulan
    Route::resource('unggulan', AdminProgramUnggulanController::class);
    Route::post('unggulan-image/{unggulan}', [AdminProgramUnggulanController::class, 'imageStore'])->name('unggulan.image.store');
    Route::delete('unggulan-image/{unggulan}', [AdminProgramUnggulanController::class, 'imageDestroy'])->name('unggulan.image.destroy');
    Route::post('unggulan-publish/{unggulan}', [AdminProgramUnggulanController::class, 'publish'])->name('unggulan.publish');

});



require __DIR__ . '/auth.php';
