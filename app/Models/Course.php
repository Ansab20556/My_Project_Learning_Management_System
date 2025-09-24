<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// class Course extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'specialization_id',
//         'title',
//         'description',
//         'cover_image',
//         'duration',
//     ];

//     // * الكورس ينتمي إلى تخصص واحد

//     public function specialization()
//     {
//         return $this->belongsTo(Specialization::class);
//     }

//     /**
//      * الكورس يحتوي على عدة وحدات
//      */
//     public function modules()
//     {
//         return $this->hasMany(Module::class);
//     }

//     /**
//      * الكورس يمكن أن يدرّسه عدة مدرسين (Many to Many)
//      */
//     public function teachers()
//     {
//         return $this->belongsToMany(Teacher::class, 'course_teacher');
//     }

//     public function assignments()
// {
//     return $this->hasMany(Assignment::class);
// }


// public function students()
// {
//     return $this->belongsToMany(User::class, 'course_user');
// }

// }

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'specialization_id',
        'title',
        'description',
        'cover_image',
        'duration',
    ];

    // الكورس ينتمي إلى تخصص واحد
    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    // الكورس يحتوي على عدة وحدات
    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    // الكورس يدرّسه عدة مدرسين
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'course_teacher', 'course_id', 'teacher_id');
    }

    // الكورس له تكاليف
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    // الكورس له طلاب
    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id');
    }
}

