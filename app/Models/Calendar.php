<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function questions()
    {
        return $this->hasMany('App\Models\CalendarQuestion', 'calendar_id')->whereStatus('yes')->orderBy('sort', 'asc');
    }

    public function curriculum()
    {
        return $this->belongsTo('App\Models\Curriculum', 'curriculum_id');
    }

    public function lesson()
    {
        return $this->belongsTo('App\Models\Lesson', 'lesson_id');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id');
    }

    public function skills()
    {
        return $this->belongsToMany('App\Models\Skill', 'exam_skills','exam_id','skill_id')->distinct();
    }

}
