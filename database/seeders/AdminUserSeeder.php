<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@polbeng.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // User 1
        User::create([
            'name' => 'User 1',
            'email' => 'user1@example.com',
            'password' => Hash::make('userpassword1'),
            'role' => 'mahasiswa',
        ]);

        // User 2
        User::create([
            'name' => 'User 2',
            'email' => 'user2@example.com',
            'password' => Hash::make('userpassword2'),
            'role' => 'mahasiswa',
        ]);

        // User 3
        User::create([
            'name' => 'User 3',
            'email' => 'user3@example.com',
            'password' => Hash::make('userpassword3'),
            'role' => 'mahasiswa',
        ]);
    }
}
