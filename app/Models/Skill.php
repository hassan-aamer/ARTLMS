<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $guarded = [''];


    public function images()
    {
        return $this->hasMany('App\Models\SkillImage', 'skill_id');
    }

}
