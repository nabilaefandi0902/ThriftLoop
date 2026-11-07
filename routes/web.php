<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminCurationController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Registrasi dan Login
Route::middleware('guest')->group(function () {

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Dashboard Admin dan Kurasi Produk
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard Admin
    Route::get('/admin/dashboard', function () {
        return 'Dashboard Admin ThriftLoop';
    })->name('dashboard.admin');

    // Menampilkan daftar produk yang menunggu kurasi
    Route::get('/admin/curation', [AdminCurationController::class, 'index'])
        ->name('admin.curation.index');

    // Menampilkan detail produk
    Route::get('/admin/curation/{product}', [AdminCurationController::class, 'show'])
        ->name('admin.curation.show');

    // Memproses hasil verifikasi produk
    Route::post('/admin/curation/{product}/verify', [AdminCurationController::class, 'verify'])
        ->name('admin.curation.verify');
});

// Dashboard Seller dan Produk
Route::middleware(['auth', 'role:seller'])->group(function () {

    // Dashboard Seller
    Route::get('/seller/dashboard', function () {
        return 'Dashboard Seller ThriftLoop';
    })->name('dashboard.seller');

    // Menampilkan daftar produk milik Seller
    Route::get('/seller/products', [ProductController::class, 'index'])
        ->name('seller.products.index');

    // Menampilkan formulir tambah produk
    Route::get('/seller/products/create', [ProductController::class, 'create'])
        ->name('seller.products.create');

    // Menyimpan produk baru
    Route::post('/seller/products', [ProductController::class, 'store'])
        ->name('seller.products.store');
});
