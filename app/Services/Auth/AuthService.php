<?php

namespace App\Services\Auth;

use App\Http\Resources\Auth\AuthResource;
use App\Models\User;
use App\Models\Role;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService {

    public function register(array $data) {

        return DB::transaction(function() use ($data) {

            $user = User::create($data);

            return $user;
        });
    }

    public function login(array $data) {

        $user = User::where('email', $data['email'])->first();

        if($user && Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {

            $refreshTokenInSec = Config::get('jwt.refresh_ttl') * 60;
            $token = JWTAuth::fromUser($user);

            return [
                'user' => new AuthResource($user),
                'token' => $token,
                'refresh_in' => $refreshTokenInSec
            ];
        }

        throw new Exception('Invalid email or password');

    }

    public function logout() {

        $authUser = Auth::user();

    }

    public function me() {
        //
    }
}
