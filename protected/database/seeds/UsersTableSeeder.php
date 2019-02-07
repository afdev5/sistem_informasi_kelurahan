<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
        	['nama' => 'Super Admin',
             'email' => 'superadmin@mail.com', 
             'password' => bcrypt('superadmin'), 
             'level' => '1',
             'kelurahan_id' => '1'
            ],
        ];

        DB::table('users')->insert($users);
    }
}
