<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomToken extends Model
{
    use HasFactory;
    protected $guarded = [''];


    protected $casts = [ 'token_exp'=>'datetime'];


    public function getTokenValidAttribute()
    {
        return $this->token_exp->lte(Carbon::now()->subMinutes(10)) ? false : true;
    }

}
