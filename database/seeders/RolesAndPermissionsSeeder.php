<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'view orders']);
        Permission::create(['name' => 'create orders']);
        Permission::create(['name' => 'delete orders']);

        Permission::create(['name' => 'create vitals']);

        Permission::create(['name' => 'notify patients']);

        Permission::create(['name' => 'create results']);
        
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'edit roles']);
        Permission::create(['name' => 'delete roles']);

        Role::create(['name' => 'Super Admin']);

        $superAdmin = User::create([
            'name' => 'Moulham Roumieh',
            'email' => 'mroumia@gmail.com',
            'password' => '$2y$10$RzU2DMZB0HoA2R9U5QaMx.BzhXhzNxb5L9lAJULJ.15L6pl/Kg8Va'
        ]);

        $superAdmin->assignRole('Super Admin');
    }
}
