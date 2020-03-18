<?php

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
        $now = date('Y-m-d h:i:s');
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('iamadmin'),
            'created_at' => $now,
            'updated_at' => $now
        ]);
        DB::table('users')->insert([
            'name' => 'Johnny Client',
            'email' => 'johnnyc@test.com',
            'password' => Hash::make('someclient'),
            'created_at' => $now,
            'updated_at' => $now
        ]);
        DB::table('users')->insert([
            'name' => 'Jane Realtor',
            'email' => 'janetherealtor@test.com',
            'password' => Hash::make('superrealtor'),
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
