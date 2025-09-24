<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Assignment;
use App\Models\Course;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admins.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

            $user->administration_level = $request->administration_level;
            $user->save();

            // إذا أصبح مدرسًا وأنشئ سجل المدرس
            if ($user->administration_level == 1) {
                Teacher::firstOrCreate(
                    ['user_id' => $user->id],
                    ['name' => $user->name]
                );
            } else {
                // إذا لم يعد مدرسًا، احذفه من جدول teachers
                Teacher::where('user_id', $user->id)->delete();
            }

            session()->flash('flash_message', 'تم تعديل صلاحيات المستخدم بنجاح');

            return redirect(route('admin.users.index'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('flash_message','تم حذف المستخدم بنجاح');
        return redirect(route('users.index'));
    }


    public function enroll(Course $course)
{
    $user = auth()->user();

    // تحقق إذا كان المستخدم طالب فقط
    if ($user->administration_level != 0) {
        return redirect()->back()->with('error', 'غير مسموح لك بالتسجيل.');
    }

    // تسجيل الطالب في الكورس
    $course->students()->syncWithoutDetaching($user->id);

    return redirect()->back()->with('success', 'تم تسجيلك في الكورس بنجاح.');
}

public function myAssignments()
{
    $user = auth()->user();

    // جلب كل التكاليف الخاصة بالكورسات اللي الطالب مسجل فيها
    $assignments = Assignment::whereHas('course.students', function($q) use ($user) {
        $q->where('user_id', $user->id);
    })->with('course')->get();

    return view('dashboard.mys', compact('assignments'));
}



public function submitAssignment(Request $request, Assignment $assignment)
{
    $request->validate([
        'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB
    ]);

    $user = auth()->user();

    // تخزين الصورة في storage/app/public/assignments
    $filePath = $request->file('file')->store('assignments', 'public');

    // حفظ الصورة مع الطالب في pivot table
    $assignment->students()->syncWithoutDetaching([
        $user->id => ['file_path' => $filePath]
    ]);

    return redirect()->route('student.assignments.my')
    ->with('success', 'تم رفع الصورة بنجاح');
}

}
