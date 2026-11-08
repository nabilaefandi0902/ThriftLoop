<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NegotiationController;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk fitur Bidding
Route::post('/products/{productId}/bidding', [NegotiationController::class, 'store'])
    ->name('bidding.store');

Route::patch('/negotiations/{id}/accept', [NegotiationController::class, 'accept'])
    ->name('bidding.accept');

Route::patch('/negotiations/{id}/reject', [NegotiationController::class, 'reject'])
    ->name('bidding.reject');
