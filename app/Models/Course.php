<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\User', 'teacher_id');
    }
    public function scheduled()
    {
        return $this->belongsTo('App\Models\Scheduled', 'scheduled_id')->whereStatus('yes');
    }

    public function courseTerm()
    {
        return $this->belongsTo('App\Models\Term', 'term');
    }

    public function lesson()
    {
        return $this->belongsTo('App\Models\Lesson', 'lesson_id')->whereStatus('yes');
    }


    public function skills()
    {
        return $this->belongsToMany('App\Models\Skill', 'course_skills','course_id','skill_id')->distinct();
    }


    public function files()
    {
        return $this->hasMany('App\Models\ModuleFile', 'module_id','id')->where('module_name', 'Course');
    }

    public function questions()
    {
        return $this->hasMany('App\Models\CourseQuestionAnswer', 'course_id');
    }


    public function comments()
    {
        return $this->hasMany('App\Models\Rating', 'course_id');
    }


}
