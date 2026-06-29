<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/rooms/{id}', [RoomController::class, 'show'])
    ->name('rooms.show');
Route::get('/buildings/{id}', [BuildingController::class, 'show'])
    ->name('buildings.show');
Route::get('/buildings/{id}/rooms', [BuildingController::class, 'rooms'])
    ->name('buildings.rooms');
Route::get("/forgot",[LoginController::class,"forgot"])->name("forgot");

Route::post('/forgot-password', [LoginController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [LoginController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [LoginController::class, 'updatePassword'])->name('password.update');
Route::get('/search-users', [UserController::class, 'searchUsers'])
    ->name('search.users');
Route::put('/buildings/{id}/toggle-status', [BuildingController::class, 'toggleStatus'])
    ->name('buildings.toggleStatus');
Route::delete('/notifications/clear',
    [UserController::class, 'clearAll'])
    ->name('notifications.clear');
Route::resource("/payments",PaymentController::class);
Route::post('/payments/{id}/verify',
    [PaymentController::class,'verify'])
    ->name('payments.verify');
Route::get("/tepro",[BookingController::class,"tenantProfile"])->name("tenant");

Route::get('/book-room/{id}', function ($id) {

    session(['selected_room' => $id]);

    if (Auth::check()) {
        return redirect()->route('bookings.index');
    }

    return redirect()->route('signup');

})->name('book.room');
