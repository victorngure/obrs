<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SysAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            
            'name' => 'Administrator',
            'email' => 'webmaster@obrs.com',
            'email_verified_at' => '2020-11-10 12:00:00',
		    'password' => Hash::make('secret'),
		    'created_at' => date('Y-m-d H:i:s'),
		    'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
