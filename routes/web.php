<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlaceEditController;
use App\Http\Controllers\PlaceRemoveController;
use App\Http\Controllers\PlaceReviewController;
use App\Http\Controllers\PlacePreviewController;
use App\Http\Controllers\PlacePublishController;
use App\Http\Controllers\DashboardUsersController;
use App\Http\Controllers\DashboardPendingController;
use App\Http\Controllers\DashboardAllPlacesController;
use App\Http\Controllers\DashboardSettingsController;
use App\Http\Controllers\PlaceAddController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get( '/place/add', [PlaceAddController::class, "add"])->middleware('auth')->name('add-new-place');
Route::get('/place/{id}/add', [PlaceAddController::class, "index"])->middleware('auth')->name('add');
Route::view('/new-place-confirmation', 'new-place-confirmation.index')->middleware('auth')->name('new-place-confirmation');
Route::get('/about', [AboutController::class, "index"])->name('about');
Route::get('/contact', [ContactController::class, "index"])->name('contact');
Route::post('/contact', [ContactController::class, "store"])->name('contact');
Route::get('/places', [PlaceController::class, "index"])->name('places');
Route::get('/place/{place}/edit', [PlaceEditController::class, "index"])->name('place.edit');
Route::get('/place/{place}/review', [ PlaceReviewController::class, "index"])->name('place.review');
Route::get('/place/{param}', [PlacePreviewController::class, "index"])->name('place.preview');
Route::delete('/places/{place}/delete', [PlaceRemoveController::class, "delete"])->middleware('auth')->name('places.delete');

Route::get( '/dashboard', [DashboardController::class, 'index'])->name("dashboard");
Route::get('/dashboard/settings', [DashboardSettingsController::class, 'index'])->name("dashboard.settings")->middleware('auth');
Route::patch('/dashboard/settings', [DashboardSettingsController::class, 'update'])->name("dashboard.settings")->middleware('auth');
Route::group(['middleware' => ['role:super-user|editor']], function () {
    Route::get('/dashboard/pending', [DashboardPendingController::class, 'index'])->name("dashboard.pending");
    Route::get('/dashboard/all_places', [DashboardAllPlacesController::class, 'index'])->name("dashboard.all_places");
    Route::patch('/places/{place}/publish', [PlacePublishController::class, "publish"])->name('places.publish');
    Route::patch('/places/{place}/unpublish', [PlacePublishController::class, "unpublish"])->name('places.unpublish');
});
Route::group(['middleware' => ['role:super-user']], function () {
    Route::get('/dashboard/users', [DashboardUsersController::class, 'index'])->name("dashboard.users");
});

Auth::routes(['verify' => true]);
