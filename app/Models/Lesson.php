<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $guarded = [''];


    public function files()
    {
        return $this->hasMany('App\Models\ModuleFile', 'module_id','id')->where('module_name', 'Lesson');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\Unit', 'unit_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function scheduled()
    {
        return $this->belongsTo('App\Models\Scheduled', 'schedule_id');
    }

    public function lessonTerm()
    {
        return $this->belongsTo('App\Models\Term', 'term');
    }

    public function gallery()
    {
        return $this->belongsTo('App\Models\Gallery', 'gallery_id');
    }

    public function skills()
    {
        return $this->belongsToMany('App\Models\Skill', 'lesson_skills','lesson_id','skill_id')->distinct();
    }

    public function courses()
    {
        return $this->hasMany('App\Models\Course', 'lesson_id')->whereStatus('yes');
    }


}
