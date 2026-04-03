<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreUserRequest;
use App\Http\Resources\Auth\AuthResource;
use App\Services\Auth\AuthService;
use App\Support\ApiResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct(protected AuthService $authService) {}

    public function register(StoreUserRequest $request) {

        $data = $this->authService->register($request->validated());
        return ApiResponse::success(
            new AuthResource($data),
            'User registered with success!',
            201
        );
    }
}
