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
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleCalendarController;


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('google-calendar', [GoogleCalendarController::class, 'listEvents'])->name('google.calendar');
Route::post('google-calendar/event', [GoogleCalendarController::class, 'createEvent'])->name('google.calendar.create');
Route::get('kegiatan/{id}/google-calendar', [GoogleCalendarController::class, 'addToGoogleCalendar'])
    ->name('kegiatan.addToGoogleCalendar');

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
