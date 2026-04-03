<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = ([
            ['name' => 'view', 'guard_name' => 'api'],
            ['name' => 'post', 'guard_name' => 'api'],
            ['name' => 'update', 'guard_name' => 'api'],
            ['name' => 'delete', 'guard_name' => 'api'],
        ]);

        foreach($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission['name'],
                'guard_name' => $permission['guard_name']
            ]);
        }
    }
}
