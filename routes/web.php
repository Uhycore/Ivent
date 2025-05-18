<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PenggunaDashboardController;

Route::get('/', function () {
    return view('landing_pages');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware(['auth', 'role:pengguna'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [PenggunaDashboardController::class, 'index'])->name('user.dashboard');
    });
});

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');


    Route::prefix('admin/pengguna')->group(function () {
        Route::get('/', [PenggunaController::class, 'index'])->name('admin.pengguna.index');
        Route::get('/create', [PenggunaController::class, 'create'])->name('admin.pengguna.create');
        Route::post('/store', [PenggunaController::class, 'store'])->name('admin.pengguna.store');
        Route::get('/edit/{id}', [PenggunaController::class, 'edit'])->name('admin.pengguna.edit');
        Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])->name('admin.pengguna.update');
        Route::delete('/delete/{id}', [PenggunaController::class, 'destroy'])->name('admin.pengguna.delete');
    });

    Route::prefix('admin/event')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('admin.event.index');
        Route::get('/create', [EventController::class, 'create'])->name('admin.event.create');
        Route::post('/store', [EventController::class, 'store'])->name('admin.event.store');
        Route::get('/edit/{id}', [EventController::class, 'edit'])->name('admin.event.edit');
        Route::put('/event/{id}', [EventController::class, 'update'])->name('admin.event.update');
        Route::delete('/delete/{id}', [EventController::class, 'destroy'])->name('admin.event.delete');
    });
});
