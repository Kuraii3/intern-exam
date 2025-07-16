<?php

use App\User;
use Illuminate\Database\Seeder;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 12 active users
        for ($i = 1; $i <= 12; $i++) {
            User::  create([
                'name' => 'Active User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => bcrypt('password'),
                'active' => true, 
            ]);
        }

        // 8 inactive users
        for ($i = 1; $i <= 8; $i++) {
            User::create([
                'name' => 'Inactive User ' . $i,
                'email' => 'inactive_user' . $i . '@example.com',
                'password' => bcrypt('password'),
                'active' => false, 
            ]);
        }
    }
}
