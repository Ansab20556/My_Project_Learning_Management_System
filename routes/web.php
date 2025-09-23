<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\AssignmentController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/test-key', function () {
    return Config::get('app.key');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('layouts.main');
})->name('dashboard');


// الصفحة الرئيسية / الداشبورد
Route::get('/', [DashController::class, 'index'])->name('dash.index');



Route::prefix('/admin')->middleware('can:access-dashboard')->group(function () {

    // لوحة التحكم
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::resource('/specializations', SpecializationController::class, [
        'as' => 'admin'
    ]);

    Route::resource('/courses', CourseController::class, [
        'as' => 'admin'
    ]);

    Route::resource('/teachers', TeacherController::class, [
        'as' => 'admin'
    ]);

    Route::resource('/modules', ModuleController::class, [
        'as' => 'admin'
    ]);

    Route::resource('/lessons', LessonController::class, [
        'as' => 'admin'
    ]);
    Route::resource('/assignments', AssignmentController::class, [
        'as' => 'admin'
    ]);

    Route::resource('/users', UsersController::class, [
        'as' => 'admin'
    ])->middleware('can:update-users');
});
// -------------------------------------------------------------------------------------------

Route::prefix('/teacher')->middleware('can:access-admin')->group(function () {

    // عرض جميع الكورسات الخاصة بالمدرس الحالي
    Route::get('/courses/my', [TeacherController::class, 'myCourses'])->name('teacher.courses.my');
    // إضافة كورس جديد
    Route::get('/courses/create', [CourseController::class, 'create'])->name('teacher.courses.create');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('teacher.courses.show');
    // تعديل وحذف كورسات المدرس
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('teacher.courses.edit');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('teacher.courses.destroy');
    // ----------------------------------------
    // عرض كل التكاليف الخاصة بالكورسات التابعة للمدرس الحالي
    Route::get('/assignments/my', [TeacherController::class, 'myAssignments'])
        ->name('teacher.assignments.my');
    // إنشاء تكليف جديد لكورس
    Route::get('/assignments/create', [TeacherController::class, 'createmymyAssignments'])
        ->name('teacher.assignments.create');
    // عرض تفاصيل التكليف
    Route::get('/assignments/{assignment}', [AssignmentController::class, 'show'])
        ->name('teacher.assignments.show');

    // تعديل التكليف
    Route::get('/assignments/{assignment}/edit', [AssignmentController::class, 'edit'])
        ->name('teacher.assignments.edit');

    // حذف التكليف
    Route::delete('/assignments/{assignment}', [AssignmentController::class, 'destroy'])
        ->name('teacher.assignments.destroy');
});



Route::post('/courses/{course}/register', [CourseController::class, 'register'])
     ->name('courses.register')
     ->middleware('auth');
     Route::get('/my-courses', [CourseController::class, 'myCourses'])
     ->name('courses.my')
     ->middleware('auth');
     Route::middleware(['auth'])->group(function () {
        Route::get('/my-assignments', [UsersController::class, 'myAssignments'])->name('student.assignments.my');
    });
    Route::post('/assignments/{assignment}/submit', [UsersController::class, 'submitAssignment'])
    ->name('assignments.submit');





     Route::middleware(['auth'])->group(function() {
        Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
    });


