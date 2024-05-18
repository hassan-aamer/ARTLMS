<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function question()
    {
        return $this->belongsTo('App\Models\CalendarQuestion', 'question_id');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\User', 'student_id');
    }

}
