<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Course;

class LessonsSeeder extends Seeder
{
    public function run(): void
    {
        $course = Course::first();

        Lesson::create([
            'course_id' => $course->id,
            'title' => 'درس 1: مقدمة عن البرمجة',
            'description' => 'مقدمة عامة عن البرمجة وأساسياتها',
            'video_url' => 'https://www.example.com/video1',
            'duration' => 60,
        ]);

        Lesson::create([
            'course_id' => $course->id,
            'title' => 'درس 2: المتغيرات والشروط',
            'description' => 'تعلم المتغيرات و الجمل الشرطية',
            'video_url' => 'https://www.example.com/video2',
            'duration' => 50,
        ]);
    }
}
