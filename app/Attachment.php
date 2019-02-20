<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{

    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = [];

    /*************************************************************************/
    /*                              Relations                                */
    /*************************************************************************/
    public function attachable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongTo(User::class);
    }


    /*************************************************************************/
    /*                          Scope Queries                                */
    /*************************************************************************/
    public function scopeUserAttachments($query, $userID = null)
    {
        $userID = $userID ?? Auth::id();

        return $query->where('user_id', $userID);
    }
}
