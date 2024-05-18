<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $guarded = [''];


    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
    public function images()
    {
        return $this->hasMany('App\Models\GalleryImage', 'gallery_id');
    }

    public function files()
    {
        return $this->hasMany('App\Models\ModuleFile', 'module_id','id')->where('module_name', 'Gallery');
    }

    public function skills()
    {
        return $this->belongsToMany('App\Models\Skill', 'gallery_skills','gallery_id','skill_id')->distinct();
    }

}
