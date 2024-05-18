<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function level()
    {
        return $this->belongsTo('App\Models\Level', 'level_id');
    }
    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }

}
