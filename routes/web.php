<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BasisPengetahuanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\KambingController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'index'])->name('homepage');
Route::get('/informasi', [HomepageController::class, 'informasi'])->name('informasi');
Route::get('/metode', [HomepageController::class, 'metode'])->name('metode');
Route::get('/kontak', [HomepageController::class, 'kontak'])->name('kontak');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('penyakit', PenyakitController::class);
    Route::resource('users', UserController::class);
    Route::resource('gejala', GejalaController::class);
    Route::resource('kambing', KambingController::class);
    Route::resource('basis_pengetahuan', BasisPengetahuanController::class);
    Route::resource('kegiatan', KegiatanController::class);

    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
});
