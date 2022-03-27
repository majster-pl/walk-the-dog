<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlaceEditController;
use App\Http\Controllers\PlaceLikeController;
use App\Http\Controllers\AddNewPlaceController;
use App\Http\Controllers\PlaceRemoveController;
use App\Http\Controllers\PlacePublishController;
use App\Http\Controllers\DashboardUsersController;
use App\Http\Controllers\DashboardPendingController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get( '/add-new-place', [AddNewPlaceController::class, "index"])->middleware('auth')->name('add-new-place');
Route::post('/add-new-place', [AddNewPlaceController::class, "store"])->middleware('auth');

Route::get('/places', [PlaceController::class, "index"])->name('places');
Route::get('/place/{place}/edit', [PlaceEditController::class, "index"])->name('place.edit');
Route::patch('/place/edit', [PlaceEditController::class, "edit"]);
Route::post('/places/{place}/likes', [PlaceLikeController::class, "store"])->name('places.likes');
Route::delete('/places/{place}/likes', [PlaceLikeController::class, "destroy"])->name('places.likes');

Route::get( '/dashboard', [DashboardController::class, 'index'])->name("dashboard");
Route::group(['middleware' => ['role:super-user|editor']], function () {
    Route::get('/dashboard/pending', [DashboardPendingController::class, 'index'])->name("dashboard.pending");
    Route::patch('/places/{place}/publish', [PlacePublishController::class, "publish"])->name('places.publish');
    Route::patch('/places/{place}/unpublish', [PlacePublishController::class, "unpublish"])->name('places.unpublish');
    Route::delete('/places/{place}/delete', [PlaceRemoveController::class, "delete"])->name('places.delete');
});
Route::group(['middleware' => ['role:super-user']], function () {
    Route::get('/dashboard/users', [DashboardUsersController::class, 'index'])->name("dashboard.users");
});

Auth::routes();
