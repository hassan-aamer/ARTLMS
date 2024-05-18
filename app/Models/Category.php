<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [''];


    public function courses()
    {
        return $this->hasMany('App\Models\Course', 'category_id')->with('teacher');
    }

}
