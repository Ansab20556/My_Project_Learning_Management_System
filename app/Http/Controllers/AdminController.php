<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\Teacher;

class AdminController extends Controller
{
  
    public function index()
    {
        
        $number_of_courses = Course::count();
        $number_of_modules = Module::count();

    
        $number_of_lessons = Lesson::count();

        // حساب عدد المدربين
        $number_of_teachers = Teacher::count();

       
        return view('admins.index', compact(
            'number_of_courses',
            'number_of_modules',
            'number_of_lessons',
            'number_of_teachers'
        ));
    }
}
