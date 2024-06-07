<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolSection extends Model
{
    use HasFactory;

    protected $table = 'tool_sections';


    protected $fillable= ['section_name'];
}
