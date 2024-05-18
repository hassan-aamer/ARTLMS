<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculums';
    protected $guarded = [''];


    public function files()
    {
        return $this->hasMany('App\Models\ModuleFile', 'module_id','id')->where('module_name', 'Curriculum');
    }

    public function level()
    {
        return $this->belongsTo('App\Models\Level', 'level_id');
    }

    public function curriculumTerm()
    {
        return $this->belongsTo('App\Models\Term', 'term');
    }

    public function scheduleds()
    {
        return $this->hasMany('App\Models\Scheduled', 'curriculum_id','id')->whereStatus('yes')->orderBy('sort','asc');
    }

    public function skills()
    {
        return $this->belongsToMany('App\Models\Skill', 'curriculum_skills','curriculum_id','skill_id')->distinct();
    }
}
