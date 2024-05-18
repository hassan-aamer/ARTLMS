<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meet extends Model
{
    use HasFactory;
    protected $guarded = [''];

    //sender
    public function sender()
    {
        return $this->belongsTo('App\Models\User', 'sender_id');
    }

    //Set receiver_ids
    public function setReceiverIdsAttribute($value)
    {
        $this->attributes['receiver_ids'] = implode(',', $value);
    }

    //get  receiver_ids
    public function getReceiverIdsAttribute($value)
    {
        return explode(',', $value);
    }


}
