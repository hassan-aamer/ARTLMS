<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $guarded = [''];


    public function files()
    {
        return $this->hasMany('App\Models\ModuleFile', 'module_id','id')->where('module_name', 'Unit');
    }

    public function scheduled()
    {
        return $this->belongsTo('App\Models\Scheduled', 'scheduled_id')->whereStatus('yes');
    }

    public function unitTerm()
    {
        return $this->belongsTo('App\Models\Term', 'term');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function teachers()
    {
        return $this->belongsToMany('App\Models\User', 'unit_teachers','unit_id','teacher_id')->distinct();
    }

    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson', 'unit_id')->where('kind', 'connected')->whereStatus('yes');
    }


}
