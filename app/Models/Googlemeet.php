<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Googlemeet extends Model
{
    use HasFactory;
    protected $guarded = [''];


    public function scopeOwner($query, $id)
    {
        return $query->where('sender_id', $id)->orWhere('receiver_id', $id);
    }

    public function sender()
    {
        return $this->belongsTo('App\Models\User', 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo('App\Models\User', 'receiver_id');
    }


}
