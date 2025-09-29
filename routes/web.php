<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KlienController;
use App\Http\Controllers\Admin\PaketController;
use App\Http\Controllers\Admin\TimController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\Admin\ProyekController;
use App\Http\Controllers\Admin\TestimoniController;
use App\Http\Controllers\Admin\ArtikelBlogController;

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Klien Routes
    Route::resource('klien', KlienController::class);
    
    // Paket Routes
    Route::resource('paket', PaketController::class);
    
    // Tim Routes
    Route::resource('tim', TimController::class);
    
    // Pesanan Routes
    Route::resource('pesanan', PesananController::class);
    
    // Proyek Routes
    Route::resource('proyek', ProyekController::class);
    
    // Testimoni Routes
    Route::resource('testimoni', TestimoniController::class);
    
    // ArtikelBlog Routes
    Route::resource('artikel', ArtikelBlogController::class);
});
