<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Specialization;

use Illuminate\Http\Request;

class DashController extends Controller
{
  /**
     * عرض الصفحة الرئيسية للداشبورد (عرض التخصصات والكورسات)
     */
    public function index()
    {
        // جلب جميع التخصصات
        $specializations = Specialization::all();

        // جلب جميع الكورسات
        $courses = Course::with('specialization')->paginate(12); // مثال على صفحة واحدة بها 12 كورس

        $title = 'جميع الكورسات';

        return view('dashboard.index', compact('specializations', 'courses', 'title'));
    }

    /**
     * عرض كورسات حسب تخصص معين
     */
    public function bySpecialization($id)
    {
        $specializations = Specialization::all();
        $specialization = Specialization::findOrFail($id);

        $courses = Course::where('specialization_id', $id)
                         ->with('specialization')
                         ->paginate(12);

        $title = 'الكورسات في: ' . $specialization->name;

        return view('dashboard.index', compact('specializations', 'courses', 'title'));
    }
}
