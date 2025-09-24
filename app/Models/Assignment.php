<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;


    protected $fillable = ['title', 'description', 'course_id'];
        // علاقة الواجب بالكورس
        public function course()
        {
            return $this->belongsTo(Course::class);
        }
    
        // علاقة الواجب بالطلاب (Many-to-Many مع بيانات التسليم)
        public function students()
        {
            return $this->belongsToMany(User::class, 'assignment_student', 'assignment_id', 'student_id')
                        ->withPivot('file_path', 'note', 'grade')
                        ->withTimestamps();
        }
}
