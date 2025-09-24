<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Course;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::with('course')->get();
        return view('admins.modules.index', compact('modules'));
    }
    public function show(Module $module)
    {
        return view('admins.modules.show', compact('module'));
    }

    public function create()
    {
        $courses = Course::all(); // لاختيار الدورة المرتبطة
        return view('admins.modules.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Module::create($request->all());

        return redirect()->route('admin.modules.index')->with('success', 'تم إضافة الوحدة بنجاح');
    }

    public function edit(Module $module)
    {
        $courses = Course::all();
        return view('admins.modules.edit', compact('module', 'courses'));
    }

    public function update(Request $request, Module $module)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $module->update($request->all());

        return redirect()->route('admin.modules.index')->with('success', 'تم تعديل الوحدة بنجاح');
    }

    public function destroy(Module $module)
    {
        $module->delete();
        return redirect()->route('admin.modules.index')->with('success', 'تم حذف الوحدة بنجاح');
    }
}