<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'second_email',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getTypeAttribute($value)
    {
        if($value == 1)
        {
            $type='admin';
        }
        elseif($value == 2)
        {
            $type='teacher';
        }
        else
        {
            $type='student';
        }
        return $type;
    }


    //
    public function userInfo()
    {
        return $this->hasOne('App\Models\UserInfo', 'user_id');
    }


    public function courses()
    {
        return $this->hasMany('App\Models\Course', 'teacher_id');
    }



}
