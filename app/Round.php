<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{


    /*************************************************************************/
    /*                              Relations                                */
    /*************************************************************************/
    public function users()
    {
        return $this->belongsToMany(User::class, 'progress')->as('progress')->withPivot('idea_id', 'submission', 'published', 'finished', 'grade');
    }

    public function ideas()
    {
        return $this->hasMany(Idea::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
    /*************************************************************************/
    /*                          Scope Queries                                */
    /*************************************************************************/
    public function scopeStarted($query)
    {
        return $query->whereStarted(true)->whereDate('due_date', '>', Carbon::now());
    }

    /*************************************************************************/
    /*                              Methods                                  */
    /*************************************************************************/
    /**
     * Check if the round started
     *
     * @return boolean
     */
    public function isStarted()
    {
        return $this->started && strtotime($this->due_date) > strtotime(Carbon::now());
    }

    /**
     * Check if the round finished
     *
     * @return boolean
     */
    public function isFinished()
    {
        return $this->started && strtotime($this->due_date) < strtotime(Carbon::now());
    }

    public function remainingDate()
    {
        return 1;
    }

    public function dueDate()
    {
        return 1;
    }

    public function addNewUser(Idea $idea, User $user = null)
    {
        $user = $user ?? Auth::user();

        $pivots = [
            'idea_id' => $idea->id,
        ];

        if($this->isUserAdded($user)) {
            $this->users()->updateExistingPivot($user, $pivots);
        } else {
            $this->users()->attach($user, $pivots);
        }
    }

    private function isUserAdded(User $user)
    {
        return $this->users()->wherePivot('user_id', $user->id)->exists();
    }

    /*************************************************************************/
    /*                              Accessors                                */
    /*************************************************************************/
    public function getStatusAttribute()
    {
        if (!$this->started) {
            return 'closed';
        } else if ($this->isStarted()) {
            return 'started';
        } elseif ($this->isFinished()) {
            return 'finished';
        }
    }

}
