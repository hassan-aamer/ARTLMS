<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarQuestion extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function calendar()
    {
        return $this->belongsTo('App\Models\Calendar', 'calendar_id');
    }


    public function choices()
    {
        return $this->hasMany('App\Models\CalendarQuestionChoice', 'question_id');
    }


}
