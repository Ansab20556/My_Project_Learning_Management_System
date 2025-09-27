<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialization;

class SpecializationsSeeder extends Seeder
{
    public function run(): void
    {
        Specialization::create(['name' => 'علوم الحاسوب', 'description' => 'تخصص علوم الحاسوب']);
        Specialization::create(['name' => 'هندسة البرمجيات', 'description' => 'تخصص هندسة البرمجيات']);
        Specialization::create(['name' => 'الذكاء الاصطناعي', 'description' => 'تخصص الذكاء الاصطناعي']);
    }
}
