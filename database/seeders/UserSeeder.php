<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Valerii Skliar',
                'email' => 'test@web.com',
                'password' => 'aSFwA6UdPDj6yqD',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
            ],
            [
                'name' => 'Bob Builder',
                'email' => 'bob.builder@example.com',
                'password' => 'Roma1234',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
            ]
        ];

        foreach ($users as $user) {
            User::updateOrCreate(['email' => $user['email']], $user);
        }
    }
}
