<?php

namespace App\Services\Role;

use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleService {

    public function index() {

        return Role::with(['permissions'])->get();

    }

    public function store(array $data) {

        return DB::transaction(function () use ($data) {

            $role = Role::create([
                'name' => $data['name'],
                'guard_name' => 'api'
            ]);

            return $role->fresh();

        });

    }

    public function show(Role $role) {

        return $role->load(['permissions']);

    }

    public function update(array $data, Role $role) {

        return DB::transaction(function () use ($data, $role) {

            $role->update([
                'name' => $data['name'],
                'guard_name' => 'api'
            ]);

            $role->fresh();

            return $role->load(['permissions']);

        });

    }

    public function destroy(Role $role) {

        return $role->delete();

    }
}
