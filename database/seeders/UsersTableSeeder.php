<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        // \App\Models\User::create([
        //     // Admin Account
        //     'name' => 'Admin Dwiki',
        //     'email' => 'admin@email.com',
        //     'phone' => '08123456789',
        //     'roles' => 'ADMIN',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('root'),
        // ]);
    }
}
