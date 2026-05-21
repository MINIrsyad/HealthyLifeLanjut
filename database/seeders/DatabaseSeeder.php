<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin default
        User::firstOrCreate(
            ['email' => 'admin@healthylife.id'],
            [
                'name'     => 'Administrator',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
            ]
        );

        // Contoh user biasa
        User::firstOrCreate(
            ['email' => 'user@healthylife.id'],
            [
                'name'     => 'User Demo',
                'password' => Hash::make('user1234'),
                'role'     => 'user',
            ]
        );
    }
}
