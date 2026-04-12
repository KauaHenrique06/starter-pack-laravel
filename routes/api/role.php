<?php

use App\Http\Controllers\Role\RoleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function() {
    Route::get('/', [RoleController::class, 'index'])->middleware('can:role.view');
    Route::post('/', [RoleController::class, 'store'])->middleware('can:role.post');
    // Route::get();
    // Route::update();
    // Route::delete();
});

