<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheduled extends Model
{
    use HasFactory;
    protected $guarded = [''];


    public function files()
    {
        return $this->hasMany('App\Models\ModuleFile', 'module_id','id')->where('module_name', 'Scheduled');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id')->whereStatus('yes');
    }

    public function scheduleTerm()
    {
        return $this->belongsTo('App\Models\Term', 'term');
    }

    public function curriculum()
    {
        return $this->belongsTo('App\Models\Curriculum', 'curriculum_id')->whereStatus('yes');
    }

    public function units()
    {
        return $this->hasMany('App\Models\Unit', 'scheduled_id')->whereStatus('yes');
    }

    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson', 'schedule_id')->whereStatus('yes');
    }

    public function courses()
    {
        return $this->hasMany('App\Models\Course', 'scheduled_id')->whereStatus('yes');
    }



}
