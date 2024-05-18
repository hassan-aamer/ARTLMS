<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAnswerDegree extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function student()
    {
        return $this->belongsTo('App\Models\User', 'student_id');
    }

    public function calendar()
    {
        return $this->belongsTo('App\Models\Calendar', 'calendar_id');
    }
    public function curriculum()
    {
        return $this->belongsTo('App\Models\Curriculum', 'curriculum_id');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\StudentAnswer', 'student_answer_degree_id');
    }


}
