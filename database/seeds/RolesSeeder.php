<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role =  Role::create([
            'name' => 'Super Administrator',
        ]);

        $permission = Permission::all();
        $role->syncPermissions($permission);

        User::where('email', 'webmaster@obrs.com')->first()->roles()->attach(Role::where('name', 'Super Administrator')->first()); 
    }
}
