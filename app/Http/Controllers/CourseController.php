<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

use App\Models\Specialization;
use App\Models\Teacher;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // جلب كل الكورسات مع التخصص والمدرسين
        $courses = Course::with(['specialization', 'teachers'])->paginate(6);

        return view('admins.course.index', compact('courses'));
    }

    public function create()
    {
        $specializations = Specialization::all();
        $teachers = Teacher::all();

        return view('admins.course.create', compact('specializations', 'teachers'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'title'           => 'required|string|max:255',
            'description'     => 'nullable|string',
            'duration'        => 'nullable|integer',
            'cover_image'     => 'required|image|mimes:jpg,jpeg,png',
            'specialization'  => 'required|exists:specializations,id',
            'teachers'        => 'required|array',
            'teachers.*'      => 'exists:teachers,id',
        ]);

        // رفع الصورة
        $imagePath = $request->file('cover_image')->store('courses', 'public');

        // إنشاء الكورس
        $course = Course::create([
            'title'             => $request->title,
            'description'       => $request->description,
            'duration'          => $request->duration,
            'cover_image'       => $imagePath,
            'specialization_id' => $request->specialization,
        ]);

        if (auth()->user()->teacher) {
            $course->teachers()->attach(auth()->user()->teacher->id);
            return redirect()->route('teacher.courses.my')->with('success', 'تم إضافة الكورس بنجاح ✅');
        }

        // إذا كان الأدمن، نعيده لكل الكورسات
        return redirect()->route('admin.courses.index')->with('success', 'تم إضافة الكورس بنجاح ✅');
    }
    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('admins.course.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $specializations = Specialization::all();
        $teachers = Teacher::all();

        return view('admins.course.edit', compact('course', 'specializations', 'teachers'));
    }

    public function update(Request $request, Course $course)
{
    $request->validate([
        'title'           => 'required|string|max:255',
        'description'     => 'nullable|string',
        'duration'        => 'nullable|integer',
        'cover_image'     => 'nullable|image|mimes:jpg,jpeg,png',
        'specialization'  => 'required|exists:specializations,id',
        'teachers'        => 'required|array',
        'teachers.*'      => 'exists:teachers,id',
    ]);

    $data = [
        'title'             => $request->title,
        'description'       => $request->description,
        'duration'          => $request->duration,
        'specialization_id' => $request->specialization,
    ];

    if ($request->hasFile('cover_image')) {
        $data['cover_image'] = $request->file('cover_image')->store('courses', 'public');
    }

    $course->update($data);
    $course->teachers()->sync($request->teachers);

    // إعادة التوجيه حسب نوع المستخدم
    if (auth()->user()->administration_level == 1) {
        return redirect()->route('teacher.courses.my')->with('success', 'تم تعديل الكورس بنجاح ✅');
    }

    return redirect()->route('admin.courses.index')->with('success', 'تم تعديل الكورس بنجاح ✅');
}

public function destroy(Course $course)
{
    $course->delete();

    // إعادة التوجيه حسب نوع المستخدم
    if (auth()->user()->administration_level == 1) {
        return redirect()->route('teacher.courses.my')->with('success', 'تم حذف الكورس بنجاح 🗑️');
    }

    return redirect()->route('admin.courses.index')->with('success', 'تم حذف الكورس بنجاح 🗑️');
}


// ---------------------
public function register(Course $course)
{
    $user = auth()->user();

    // هل الطالب مسجل مسبقاً؟
    if ($course->students()->where('user_id', $user->id)->exists()) {
        return back()->with('error', 'لقد سجلت في هذا الكورس مسبقاً');
    }

    // تسجيل الطالب في الكورس (جدول course_user)
    $course->students()->attach($user->id);

    return back()->with('success', 'تم تسجيلك في الكورس بنجاح');
}

public function myCourses()
{
    $user = auth()->user();
    $courses = $user->enrolledCourses()->paginate(6); // لاحظ () هنا

    return view('dashboard.index', compact('courses'));
}


}
