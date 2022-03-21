<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AddNewPlaceController;
use App\Http\Controllers\PlaceLikeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get( '/add-new-place', [AddNewPlaceController::class, "index"])->middleware('auth')->name('add-new-place');
Route::post('/add-new-place', [AddNewPlaceController:: class, "store"])->middleware('auth');

Route::get('/places', [PlaceController::class, "index"])->name('places');
Route::post('/places/{place}/likes', [PlaceLikeController::class, "store"])->name('places.likes');
Route::delete('/places/{place}/likes', [PlaceLikeController::class, "destroy"])->name('places.likes');

Route::get( '/dashboard', [DashboardController::class, 'index'])->name("dashboard");
Route::group(['middleware' => ['role:super-user|editor']], function () {
    Route::get('/dashboard/pending', [DashboardController::class, 'index'])->name("dashboard.pending");
});
Route::group(['middleware' => ['role:super-user']], function () {
    Route::get('/dashboard/users', [DashboardController::class, 'index'])->name("dashboard.users");
});

Auth::routes();
