<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function files()
    {
        return $this->hasMany('App\Models\ModuleFile', 'module_id','id')->where('module_name', 'Article');
    }

}
