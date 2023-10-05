<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Ram',
            'email' => 'ram@yopmail.com',
            'contact' => '9897022161',
            'address' => 'test Address',
            'status'=>1,
            'password' => Hash::make('123456')
        ]);
    }
}
