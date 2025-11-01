<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $adminRole = Role::create(['name' => 'super-admin']);
        $userRole = Role::create(['name' => 'user']);

        // Create permissions
        $editPermission = Permission::create(['name' => 'edit users']);
        $viewPermission = Permission::create(['name' => 'view users']);

        // Assign permissions to roles
        $adminRole->givePermissionTo($editPermission, $viewPermission);
        $userRole->givePermissionTo($viewPermission);

        // Assign role to user
        // $user = User::where('email', 'john@dd.com')->first();
        // $user->assignRole('super-admin');
    }
}
