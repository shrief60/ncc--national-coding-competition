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


    public function isFinished(User $user = null)
    {
        $user = $user ?? Auth::user();

        return Progress::isIdeaFinished($user->id, $this->id);
    }
}
