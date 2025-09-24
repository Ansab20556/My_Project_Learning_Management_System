<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Assignment;


class TeacherController extends Controller
{

    public function index()
    {
           // جلب جميع المستخدمين اللي عندهم administration_level > 0
           $teachers = Teacher::all();

    return view('admins.teachers.index', compact('teachers'));
    }


    public function create()
    {
        return view('admins.teachers.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'bio'   => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['name', 'bio']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('teachers', 'public');
        }

        Teacher::create($data);

        return redirect()->route('admin.teachers.index')
            ->with('success', 'تمت إضافة المدرّب بنجاح');
    }


    public function show(Teacher $teacher)
    {
        return view('admins.teachers.show', compact('teacher'));
    }


    public function edit(Teacher $teacher)
    {
        return view('admins.teachers.edit', compact('teacher'));
    }


    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'bio'   => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['name', 'bio']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('teachers', 'public');
        }

        $teacher->update($data);

        return redirect()->route('admin.teachers.index')
            ->with('success', 'تم تعديل بيانات المدرّب بنجاح');
    }

    /**
     * حذف المدرّب
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('admin.teachers.index')
            ->with('success', 'تم حذف المدرّب بنجاح');
    }


    public function myCourses()
    {
        $teacher = auth()->user()->teacher; // جلب سجل المدرس المرتبط بالمستخدم الحالي
    
        if (!$teacher) {
            $courses = collect(); // إذا المستخدم ليس مدرسًا، مجموعة فارغة
        } else {
            $courses = $teacher->courses()->with('specialization', 'teachers')->get(); // جلب كورسات المدرس فقط
        }
    
        return view('admins.teachers.courses.my', compact('courses')); // تمرير الكورسات للعرض
    }


    public function myAssignments()
    {
        $teacher = auth()->user()->teacher; // جلب سجل المدرس المرتبط بالمستخدم الحالي

        if (!$teacher) {
            $assignments = collect(); // إذا المستخدم ليس مدرسًا، مجموعة فارغة
        } else {
            // جلب كل التكاليف للكورسات التي يدرّسها هذا المدرس
            $assignments = Assignment::whereHas('course.teachers', function($q) use ($teacher) {
                $q->where('teacher_id', $teacher->id);
            })->with('course')->get();
        }

        return view('admins.teachers.assignments.my', compact('assignments')); // تمرير التكاليف للعرض
    }

    public function createmymyAssignments()
{
    $teacher = auth()->user()->teacher;

    // جلب كورسات المدرس فقط
    $courses = $teacher ? $teacher->courses()->get() : collect();

    return view('admins.assignments.create', compact('courses'));
}
    
    

}
