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
        	['nama' => 'Admin Kominfo',
             'email' => 'admin@tomohon.go.id', 
             'password' => bcrypt('admin'), 
             'level' => '1',
            ],
        ];

        DB::table('users')->insert($users);
    }
}
