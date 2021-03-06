<?php

namespace Database\Seeders;

use App\Models\PlaceType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit places']);
        Permission::create(['name' => 'delete places']);
        Permission::create(['name' => 'publish places']);
        Permission::create(['name' => 'unpublish places']);
        Permission::create(['name' => 'edit users']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'user']);
        $role1->givePermissionTo('edit places');
        $role1->givePermissionTo('delete places');

        $role2 = Role::create(['name' => 'editor']);
        $role2->givePermissionTo('edit places');
        $role2->givePermissionTo('delete places');
        $role2->givePermissionTo('publish places');
        $role2->givePermissionTo('unpublish places');

        $role3 = Role::create(['name' => 'super-user']);

        // create demo users
        $user = User::factory()->create([
            'name' => 'Example Noraml User',
            'email' => 'user@walkthedog.com',
            'password' => 'password'
        ]);
        $user->assignRole($role1);

        $user = User::factory()->create([
            'name' => 'Example Editor User',
            'email' => 'editor@walkthedog.com',
            'password' => 'password'
        ]);
        $user->assignRole($role2);

        $user = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@walkthedog.com',
            'password' => 'password'
        ]);
        $user->assignRole($role3);

        // preset values for place type
        PlaceType::create(['name' => 'Field']);
        PlaceType::create(['name' => 'Beach']);
        PlaceType::create(['name' => 'Forest']);
        PlaceType::create(['name' => 'Mountains']);

    }
}
