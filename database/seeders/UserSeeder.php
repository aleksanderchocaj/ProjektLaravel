<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Administrator
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@quiz.pl',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // 2. Student (Zwykły użytkownik)
        User::create([
            'name' => 'Student',
            'email' => 'student@quiz.pl',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);
    }
}