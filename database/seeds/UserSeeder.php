<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'itroots',
            'username' => 'superuser',
            'password' => Hash::make('superuser'),
            'admin_role'=>1,
        ]);
    }
}
