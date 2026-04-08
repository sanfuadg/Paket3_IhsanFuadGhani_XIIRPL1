<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\StudentAspirasiController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/siswa/form');

Route::get('/siswa/form', [StudentAspirasiController::class, 'create'])->name('siswa.form');
Route::post('/siswa/aspirasi', [StudentAspirasiController::class, 'store'])->name('siswa.aspirasi.store');
Route::get('/siswa/hasil', [StudentAspirasiController::class, 'hasil'])->name('siswa.hasil');

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.attempt');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware('admin.auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/aspirasi/{inputAspirasi}', [AdminDashboardController::class, 'detail'])->name('aspirasi.detail');
    Route::put('/aspirasi/{inputAspirasi}', [AdminDashboardController::class, 'update'])->name('aspirasi.update');
    Route::get('/histori', [AdminDashboardController::class, 'histori'])->name('histori');
});
