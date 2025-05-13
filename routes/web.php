<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PenggunaController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin/pengguna')->group(function () {
    Route::get('/', [PenggunaController::class, 'index'])->name('admin.pengguna.index');
    Route::get('/create', [PenggunaController::class, 'create'])->name('admin.pengguna.create');
    Route::post('/store', [PenggunaController::class, 'store'])->name('admin.pengguna.store');
    Route::get('/edit/{id}', [PenggunaController::class, 'edit'])->name('admin.pengguna.edit');
    Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])->name('admin.pengguna.update');
    Route::delete('/delete/{id}', [PenggunaController::class, 'destroy'])->name('admin.pengguna.delete');
});
