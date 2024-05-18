<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use HasFactory;
    protected $guarded = [''];


    public function articles()
    {
        return $this->hasMany('App\Models\Article', 'category_id')->where('status', 'yes');
    }

}
