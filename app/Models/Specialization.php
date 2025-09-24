<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'what_you_will_learn',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}