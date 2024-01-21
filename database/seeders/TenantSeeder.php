<?php

namespace Database\Seeders;

// database/seeders/TenantSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TenantSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Tenant User',
            'email' => 'tenant@gmail.com',
            'password' => Hash::make('Password'),
            'role' => 'tenant',
            'remember_token' => Str::random(10),
        ]);

        // You can add more users as needed
    }
}
