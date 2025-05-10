<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $actions = [
            'view',
            'create',
            'update',
            'delete',
        ];

        $policies = [
            'user',
            'role',
            'permission',
            'classroom',
            'student',
        ];

        foreach ($policies as $policy) {
            $permissions = [];

            foreach ($actions as $action) {
                $permissions[] = [
                    'name' => $action . '-' . $policy,
                    'guard_name' => config('api.guard'),
                ];
            }

            \Spatie\Permission\Models\Permission::upsert($permissions, ['name', 'guard_name'], ['name']);
        }

        $adminRole = \Spatie\Permission\Models\Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => config('api.guard'),
        ]);

        $adminRole->givePermissionTo(\Spatie\Permission\Models\Permission::all());

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
