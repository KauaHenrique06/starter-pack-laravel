<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class AuthService {

    public function register(array $data) {

        return DB::transaction(function() use ($data) {

            $user = User::create($data);

            return $user;
        });
    }
}
