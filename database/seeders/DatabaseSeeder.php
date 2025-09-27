<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            TeachersSeeder::class,
            SpecializationsSeeder::class,
            CoursesSeeder::class,
            LessonsSeeder::class,
            AssignmentsSeeder::class,
        ]);
    }
}
