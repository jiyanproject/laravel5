<?php

use Illuminate\Database\Seeder;
use iteos\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'User Demo',
        	'email' => 'demo@local.com',
        	'password' => bcrypt('password'),
        ]);
    }
}
