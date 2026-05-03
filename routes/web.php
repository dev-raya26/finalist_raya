<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get("/showlogin",[LoginController::class,"showlogin"])->name('showlogin');
Route::post("/login",[LoginController::class,"login"])->name('login');
Route::post("/logout",[LoginController::class,"logout"])->name('logout');
Route::get("/signup",[LoginController::class,"signup"])->name('signup');
Route::get("/",[LoginController::class,"home"])->name('home');
Route::get("/dashboard",[LoginController::class,"dashboard"])->name('dashboard');
Route::resource("/reguser",UserController::class);
Route::resource('buildings', BuildingController::class);
Route::resource('rooms', RoomController::class);
Route::resource('bookings', BookingController::class);
