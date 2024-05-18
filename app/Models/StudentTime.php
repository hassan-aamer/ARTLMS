<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTime extends Model
{
    use HasFactory;
    protected $table = 'student_times';
    protected $fillable = ['user_id', 'start_time', 'end_time'];
    public $timestamps = true;
}
