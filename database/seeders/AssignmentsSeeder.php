<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Assignment;
use App\Models\Course;

class AssignmentsSeeder extends Seeder
{
    public function run(): void
    {
        $course = Course::first();

        Assignment::create([
            'course_id' => $course->id,
            'title' => 'واجب 1: إنشاء مشروع بسيط',
            'description' => 'قم بإنشاء مشروع بسيط باستخدام PHP و Laravel',
        ]);
    }
}
