<?php

namespace App\Services\Permission;

use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionService {

    public function store(array $data) {

        return DB::transaction(function () use ($data) {

            $permission = Permission::create([
                'name' => $data['name'],
                'guard_name' => 'api'
            ]);

            return $permission;

        });

    }
}
