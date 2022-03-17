<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AddNewPlaceController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get( '/add-new-place', [AddNewPlaceController::class, "index"])->middleware('auth')->name('add-new-place');
Route::post('/add-new-place', [AddNewPlaceController::class, "store"])->middleware('auth');
Route::get('/places', [PlaceController::class, "index"])->name('places');
Route::get('/dashboard', [DashboardController::class, 'index'])->name("dashboard");

Auth::routes();
