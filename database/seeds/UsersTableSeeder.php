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
        //Admin
        DB::table('users')->insert([
            'name' => 'admin1',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('123456789'),
            'type' => 00,
        ]);
        DB::table('users')->insert([
            'name' => 'admin2',
            'email' => 'admin2@gmail.com',
            'password' => bcrypt('123456789'),
            'type' => 00,
        ]);

        //Support Supervisor
        DB::table('users')->insert([
            'name' => 'supportSupervisor1',
            'email' => 'supportSupervisor1@gmail.com',
            'password' => bcrypt('123456789'),
            'type' => 01,
        ]);
        DB::table('users')->insert([
            'name' => 'supportSupervisor2',
            'email' => 'supportSupervisor2@gmail.com',
            'password' => bcrypt('123456789'),
            'type' => 01,
        ]);

        //Support Agent
        DB::table('users')->insert([
            'name' => 'supportAgent1',
            'email' => 'supportAgent1@gmail.com',
            'password' => bcrypt('123456789'),
            'type' => 10,
        ]);
        DB::table('users')->insert([
            'name' => 'supportAgent2',
            'email' => 'supportAgent2@gmail.com',
            'password' => bcrypt('123456789'),
            'type' => 10,
        ]);
    }
}
