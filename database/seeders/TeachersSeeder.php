<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\User;

class TeachersSeeder extends Seeder
{
    public function run(): void
    {
        $teacherUser = User::where('administration_level', 1)->first();

        Teacher::create([
            'user_id' => $teacherUser->id,
            'name' => $teacherUser->name,
            'bio' => 'مدرس ذو خبرة في البرمجة',
            'photo' => null,
        ]);
    }
}
