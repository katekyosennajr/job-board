<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@aa.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('riangitoh'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );
    }
}
