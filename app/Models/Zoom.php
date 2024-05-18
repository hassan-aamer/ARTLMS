<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zoom extends Model
{
    use HasFactory;
    protected $guarded = [''];



    public function level()
    {
        return $this->belongsTo('App\Models\Level', 'level_id');
    }
    public function teacher()
    {
        return $this->belongsTo('App\Models\User', 'teacher_id');
    }

    public function getEndTimeAttribute($value)
    {
        $now = \Carbon\Carbon::now();

        if ($now >= $this->start_time && $now < $value)
        {
            $data =  ['alert' => 'warning', 'title' => ' الحصة جارية'];
        }
        elseif($value > $now)
        {
            $data =  ['alert' => 'success', 'title' => 'حصة قادمة'];
        }
        else
        {
            $data =  ['alert' => 'danger', 'title' =>'تم الإنتهاء من الحصة'];
        }
        return $data;
    }




}
