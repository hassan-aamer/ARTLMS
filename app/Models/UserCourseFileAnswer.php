<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourseFileAnswer extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function student()
    {
        return $this->belongsTo('App\Models\User', 'student_id');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id');
    }

}
