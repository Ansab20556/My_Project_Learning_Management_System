<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Specialization;
use App\Models\Teacher;

class CoursesSeeder extends Seeder
{
    public function run(): void
    {
        $spec = Specialization::first();
        $teacher = Teacher::first();

        $course = Course::create([
            'specialization_id' => $spec->id,
            'title' => 'مقدمة في البرمجة',
            'description' => 'تعلم أساسيات البرمجة بلغة PHP و Laravel',
            'cover_image' => null,
            'duration' => 40,
        ]);

        $course->teachers()->attach($teacher->id);
    }
}
