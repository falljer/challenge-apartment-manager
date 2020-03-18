<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d h:i:s');
        DB::table('roles')->insert(['name' => 'admin', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('roles')->insert(['name' => 'client', 'created_at' => $now, 'updated_at' => $now]);
        DB::table('roles')->insert(['name' => 'realtor', 'created_at' => $now, 'updated_at' => $now]);
    }
}
