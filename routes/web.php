<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NilaiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriController;

Route::get('/', fn () => redirect()->route('login'));

// Guest
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

// Harus login
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    // Manajemen pengguna: hanya Admin (masih placeholder)
       // Manajemen pengguna: hanya Admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
    // Manajemen materi: Admin & Dosen (masih placeholder)
        // Manajemen materi: Admin & Dosen
    Route::middleware('role:admin,dosen')->group(function () {
        Route::get('/materi', [MateriController::class, 'index'])->name('materi.index');
        Route::post('/materi', [MateriController::class, 'store'])->name('materi.store');
        Route::get('/materi/{materi}/edit', [MateriController::class, 'edit'])->name('materi.edit');
        Route::put('/materi/{materi}', [MateriController::class, 'update'])->name('materi.update');
        Route::delete('/materi/{materi}', [MateriController::class, 'destroy'])->name('materi.destroy');
    });

    // Input nilai: Dosen saja
    Route::middleware('role:dosen')->group(function () {
        Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');
        Route::post('/nilai', [NilaiController::class, 'store'])->name('nilai.store');
        Route::delete('/nilai/{nilai}', [NilaiController::class, 'destroy'])->name('nilai.destroy');
    });

    // Lihat nilai sendiri: Mahasiswa saja
    Route::middleware('role:mahasiswa')->group(function () {
        Route::get('/nilai-saya', [NilaiController::class, 'saya'])->name('nilai.saya');
    });
});