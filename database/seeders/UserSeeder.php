<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin', 
            'role' => 'admin',
            'password' => Hash::make('password123'), // Ganti password ini setelah login
        ]);

        User::create([
            'name' => 'Executive',
            'username' => 'executive', 
            'role' => 'executive',
            'password' => Hash::make('password123'), // Ganti password ini setelah login
        ]);
    }
}
