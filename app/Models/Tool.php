<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public function toolSection()
    {
        return $this->belongsTo(ToolSection::class, 'tool_section_id');
    }
}
