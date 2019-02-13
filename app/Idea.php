<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{


    /*************************************************************************/
    /*                              Relations                                */
    /*************************************************************************/
    public function users()
    {
        return $this->belongsToMany(User::class, 'progress')->as('progress')->withPivot('round_id', 'submission', 'published', 'finished', 'grade');
    }

    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    /*************************************************************************/
    /*                          Scope Queries                                */
    /*************************************************************************/
    public function scopeUserAttachments($query, $userID = null)
    {
        $userID = $userID ?? Auth::id();

        return $this->attachments()->where('user_id', $userID);
    }


    public function isFinished(User $user = null)
    {
        $user = $user ?? Auth::user();

        return Progress::isIdeaFinished($user->id, $this->id);
    }

    public function isSelected(User $user = null)
    {
        $user = $user ?? Auth::user();

        return $this->users()->wherePivot('user_id', $user->id)->exists();
    }

    public function addNewUser(User $user = null)
    {
        $user = $user ?? Auth::user();

        $this->round->addNewUser($this, $user);
    }

}
