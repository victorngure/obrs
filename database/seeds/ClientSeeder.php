<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role =  Role::create([
            'name' => 'Client',
        ]);

        $permission = array(
            'bookings'
        );

        $role->syncPermissions($permission);
    }
}
