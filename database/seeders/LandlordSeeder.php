<?php

namespace Database\Seeders;



use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LandlordSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'landlord User',
            'email' => 'Landlord@example.com',
            'password' => Hash::make('password'),
            'role' => 'landlord',
            'remember_token' => Str::random(10),
        ]);

        // You can add more users as needed
    }
}

