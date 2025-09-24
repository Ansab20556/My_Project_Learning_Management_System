<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * عرض كل الدروس.
     */
    public function index()
    {
        // جلب الدروس مع الوحدة والكورس المرتبط
        $lessons = Lesson::with('module.course')->get();

        return view('admins.Lessons.index', compact('lessons'));
    }

    /**
     * عرض نموذج إضافة درس جديد.
     */
    public function create()
    {
        $modules = Module::with('course')->get(); // لجلب جميع الوحدات والكورسات المرتبطة
        return view('admins.Lessons.create', compact('modules'));
    }

    /**
     * تخزين درس جديد.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'module_id'  => 'required|exists:modules,id',
            'description'=> 'nullable|string',
            'video'      => 'nullable|file|mimes:mp4,mov,avi',
            'duration'   => 'nullable|integer',
        ]);

        $lesson = new Lesson();
        $lesson->title = $request->title;
        $lesson->module_id = $request->module_id;
        $lesson->description = $request->description;
        $lesson->duration = $request->duration;

        // رفع الفيديو
        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('videos', 'public');
            $lesson->video_url = $path;
        }

        $lesson->save();

        return redirect()->route('admin.lessons.index')->with('success', 'تم إضافة الدرس بنجاح ✅');
    }

    // صفحة تعديل درس
    public function edit(Lesson $lesson)
    {
        $modules = Module::with('course')->get();
        return view('admins.lessons.edit', compact('lesson', 'modules'));
    }

    // تحديث درس
    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'module_id'  => 'required|exists:modules,id',
            'description'=> 'nullable|string',
            'video'      => 'nullable|file|mimes:mp4,mov,avi',
            'duration'   => 'nullable|integer',
        ]);

        $lesson->title = $request->title;
        $lesson->module_id = $request->module_id;
        $lesson->description = $request->description;
        $lesson->duration = $request->duration;

        
        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('videos', 'public');
            $lesson->video_url = $path;
        }

        $lesson->save();

        return redirect()->route('admin.Lessons.index')->with('success', 'تم تعديل الدرس بنجاح ✅');
    }

    // حذف درس
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return redirect()->route('admin.Lessons.index')->with('success', 'تم حذف الدرس بنجاح ✅');
    }

    // عرض درس
    public function show(Lesson $lesson)
    {
        return view('admins.Lessons.show', compact('lesson'));
    }
}