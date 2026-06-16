<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rbac\Permission;
use App\Models\Rbac\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'hotel_owner',
            'general_manager',
            'revenue_manager',
            'admin',
            'staff',
            'finance',
            'support_agent',
            'super_admin',
        ];

        $modules = config('nextgentrip.modules', []);
        $actions = ['view', 'create', 'update', 'delete'];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                Permission::findOrCreate("{$module}.{$action}", 'web');
            }
        }

        foreach ($roles as $roleName) {
            $role = Role::findOrCreate($roleName, 'web');

            if (in_array($roleName, ['admin', 'super_admin'], true)) {
                $role->syncPermissions(Permission::all());
            }
        }
    }
}
