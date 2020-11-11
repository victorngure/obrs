<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'roles',
            'trips',
            'bookings',
            'buses',
            'users',
            'reports',
         ];
 
 
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
