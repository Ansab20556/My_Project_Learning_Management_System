<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Course;


    class AssignmentController extends Controller
    {
        /**
         * عرض جميع التكاليف
         */
        public function index()
        {
            $assignments = Assignment::with('course')->get(); // نفس أسلوب كورسات
    
            return view('admins.assignments.index', compact('assignments'));
        }
    
        public function create()
        {
            $courses = Course::all();
            return view('admins.assignments.create', compact('courses'));
        }
    
        public function store(Request $request)
        {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'course_id' => 'required|exists:courses,id',
            ]);
    
            $assignment = Assignment::create($request->all());
    
            if (auth()->user()->type == 1) { // مدرس
                return redirect()->route('teacher.assignments.index')->with('success', 'تم إضافة التكليف بنجاح ✅');
            }
    
            return redirect()->route('admin.assignments.index')->with('success', 'تم إضافة التكليف بنجاح ✅');
        }
    
        public function show(Assignment $assignment)
        {
            return view('admins.assignments.show', compact('assignment'));
        }
    
        public function edit(Assignment $assignment)
        {
            $courses = Course::all();
            return view('admins.assignments.edit', compact('assignment', 'courses'));
        }
    
        public function update(Request $request, Assignment $assignment)
        {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'course_id' => 'required|exists:courses,id',
            ]);
    
            $assignment->update($request->all());
    
            if (auth()->user()->type == 1) { // مدرس
                return redirect()->route('teacher.assignments.index')->with('success', 'تم تعديل التكليف بنجاح ✅');
            }
    
            return redirect()->route('admin.assignments.index')->with('success', 'تم تعديل التكليف بنجاح ✅');
        }
    
        public function destroy(Assignment $assignment)
        {
            $assignment->delete();
    
            if (auth()->user()->type == 1) { // مدرس
                return redirect()->route('teacher.assignments.index')->with('success', 'تم حذف التكليف بنجاح 🗑️');
            }
    
            return redirect()->route('admin.assignments.index')->with('success', 'تم حذف التكليف بنجاح 🗑️');
        }
    }
    
