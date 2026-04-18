<?php

use App\Http\Controllers\Address\AddressController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function() {
    // Route::get('/', [AddressController::class, 'index']);
    Route::post('/', [AddressController::class, 'store']);
});
