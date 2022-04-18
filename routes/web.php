<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlaceEditController;
use App\Http\Controllers\PlaceLikeController;
use App\Http\Controllers\AddNewPlaceController;
use App\Http\Controllers\PlaceRemoveController;
use App\Http\Controllers\PlaceReviewController;
use App\Http\Controllers\PlacePreviewController;
use App\Http\Controllers\PlacePublishController;
use App\Http\Controllers\DashboardUsersController;
use App\Http\Controllers\DashboardPendingController;
use App\Http\Controllers\DashboardAllPlacesController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get( '/add-new-place', [AddNewPlaceController::class, "index"])->middleware('auth')->name('add-new-place');
Route::post( '/add-new-place', [AddNewPlaceController::class, "store"])->middleware('auth');
Route::view('/add-new-confirmation', 'new-place-confirmation.index')->middleware('auth');
Route::get('/about', [AboutController::class, "index"])->name('about');
Route::get('/contact', [ContactController::class, "index"])->name('contact');
Route::post('/contact', [ContactController::class, "store"])->name('contact');
Route::get('/places', [PlaceController::class, "index"])->name('places');
Route::get('/place/{place}/edit', [PlaceEditController::class, "index"])->name('place.edit');
Route::get('/place/{place}/review', [ PlaceReviewController::class, "index"])->name('place.review');
Route::get('/place/{id}', [PlacePreviewController::class, "index"])->name('place.preview');
Route::patch('/place/edit', [PlaceEditController::class, "edit"])->middleware('auth')->name('edit-place');
Route::post('/places/{place}/likes', [PlaceLikeController::class, "store"])->name('places.likes');
Route::delete('/places/{place}/likes', [PlaceLikeController::class, "destroy"])->name('places.likes');
Route::delete('/places/{place}/delete', [PlaceRemoveController::class, "delete"])->middleware('auth')->name('places.delete');

Route::get( '/dashboard', [DashboardController::class, 'index'])->name("dashboard");
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
