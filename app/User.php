<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const DEFAULT_AVATAR_PATH = "images/defaults/avatar.png";

    /**
     * The attributes that are mass guarded.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id');
    }

    public function sentRequests()
    {
        return $this->hasMany(FriendRequest::class, 'sender_id');
    }

    public function receivedRequests()
    {
        return $this->hasMany(FriendRequest::class, 'receiver_id');
    }

    public function getAvatarAttribute($avatar)
    {

        return $avatar ? asset("storage/{$avatar}") : asset(self::DEFAULT_AVATAR_PATH) ;
    }

    public function getLocationAttribute()
    {
        return "$this->moderya - $this->edara";
    }
}
