<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

// class User extends Authenticatable
// {
//     use HasApiTokens;
//     use HasFactory;
//     use HasProfilePhoto;
//     use Notifiable;
//     use TwoFactorAuthenticatable;
//     use Billable;

//     /**
//      * The attributes that are mass assignable.
//      *
//      * @var string[]
//      */
//     protected $fillable = [
//         'name',
//         'email',
//         'password',
//     ];

//     /**
//      * The attributes that should be hidden for serialization.
//      *
//      * @var array
//      */
//     protected $hidden = [
//         'password',
//         'remember_token',
//         'two_factor_recovery_codes',
//         'two_factor_secret',
//     ];

//     /**
//      * The attributes that should be cast.
//      *
//      * @var array
//      */
//     protected $casts = [
//         'email_verified_at' => 'datetime',
//     ];

//     /**
//      * The accessors to append to the model's array form.
//      *
//      * @var array
//      */
//     protected $appends = [
//         'profile_photo_url',
//     ];

//     public function isSuperAdmin() {
//         return $this->administration_level == 2; 
//     }
    
//     public function isAdmin() {
//         return $this->administration_level == 1; 
//     }



//     public function courses()
// {
//     // 'course_teacher' هو اسم جدول الربط
//     // 'teacher_id' هو المفتاح في pivot الذي يشير إلى users.id
//     // 'course_id' هو المفتاح الذي يشير إلى courses.id
//     return $this->belongsToMany(\App\Models\Course::class, 'course_teacher', 'teacher_id', 'course_id');
// }


// public function assignments()
// {
//     return $this->belongsToMany(Assignment::class, 'assignment_student', 'student_id', 'assignment_id')
//                 ->withPivot('file_path', 'note', 'grade')
//                 ->withTimestamps();
// }
// public function teacher()
// {
//     return $this->hasOne(Teacher::class, 'user_id');
// }
// public function enrolledCourses()
// {
//     return $this->belongsToMany(Course::class)->withTimestamps();
// }

  


// }


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable, Billable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    // ----------------------------
    // صلاحيات المستخدم
    // ----------------------------
    public function isSuperAdmin() {
        return $this->administration_level == 2; 
    }
    
    public function isAdmin() {
        return $this->administration_level == 1; 
    }

    public function isStudent() {
        return $this->administration_level == 0;
    }

    // ----------------------------
    // علاقات
    // ----------------------------

    // إذا كان مدرس → الكورسات اللي يدرّسها
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_teacher', 'teacher_id', 'course_id')
                    ->withTimestamps();
    }

    // إذا كان طالب → الكورسات اللي مسجل فيها
    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id')
                    ->withTimestamps();
    }

    // التكاليف اللي على الطالب
    public function assignments()
    {
        return $this->belongsToMany(Assignment::class, 'assignment_student', 'student_id', 'assignment_id')
                    ->withPivot('file_path', 'note', 'grade')
                    ->withTimestamps();
    }

    // علاقة المدرس (لو عندك جدول Teachers منفصل)
    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'user_id');
    }
}
