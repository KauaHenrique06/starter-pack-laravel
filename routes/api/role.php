<?php

use App\Http\Controllers\Role\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RoleController::class, 'index']);
