<?php

namespace App\Services\Role;

use Spatie\Permission\Models\Role;

class RoleService {

    public function index() {

        $role = Role::all();
        // dd($role);
        return $role;

    }
}
