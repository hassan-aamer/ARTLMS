<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function sections()
    {
        return $this->belongsToMany('App\Models\Section', 'levels_sections','level_id','section_id')->distinct();
    }

}
