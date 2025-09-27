<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // مدير عام
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
            'administration_level' => 2,
        ]);

        // أستاذ
        User::create([
            'name' => 'Teacher One',
            'email' => 'teacher1@example.com',
            'password' => Hash::make('12345678'),
            'administration_level' => 1,
        ]);

        // طالب
        User::create([
            'name' => 'Student One',
            'email' => 'student1@example.com',
            'password' => Hash::make('12345678'),
            'administration_level' => 0,
        ]);
    }
}
