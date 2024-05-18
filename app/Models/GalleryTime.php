<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryTime extends Model
{
    use HasFactory;
    protected $table = 'gallery_times';
    protected $fillable = ['user_id', 'gallery_id', 'start_time', 'end_time'];
    public $timestamps = true;
}
