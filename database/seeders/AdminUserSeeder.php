<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'touzaisaac3@gmail.com'],
            [
                'name'              => 'Touza Isaac',
                'email'             => 'touzaisaac3@gmail.com',
                'password'          => Hash::make('touza237'),
                'role'              => 'admin',
                'email_verified_at' => now(),
            ]
        );
    }
}
