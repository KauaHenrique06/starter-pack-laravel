<?php

namespace App\Services\Auth;

use App\Http\Resources\Auth\AuthResource;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService {

    public function register(array $data): array {

        return DB::transaction(function() use ($data) {

            $user = User::create($data);

            return $user;
        });
    }

    public function login(array $data): array {

        $user = User::where('email', $data['email'])->first();

        if($user && Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {

            $refreshTokenInSec = Config::get('jwt.refresh_ttl') * 60;
            $token = JWTAuth::fromUser($user);

            $user->load(['roles', 'permissions']);
            return [
                'user' => new AuthResource($user),
                'token' => $token,
                'refresh_in' => $refreshTokenInSec
            ];
        }

        throw new AuthenticationException();
    }

    public function me(): User {

        $authUser = Auth::user();
        $authUser->load('addresses', 'roles', 'permissions');
        return $authUser;

    }

    public function refreshToken() {

        $refreshTokenInSec = Config::get('jwt.refresh_ttl') * 60;
        $token = auth('api')->refresh();

        return [
            'token' => $token,
            'refresh_in' => $refreshTokenInSec
        ];

    }
}
