<?php

namespace App;

use Carbon\Carbon;
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
    public function isStarted()
    {
        return $this->started && strtotime($this->due_date) > strtotime(Carbon::now());
    }

    public function isPassed()
    {

        return $this->started && strtotime($this->due_date) < strtotime(Carbon::now());
    }


    public function getStatusAttribute()
    {
        if (!$this->started) {
            return 'closed';
        } else if ($this->isStarted()) {
            return 'started';
        } elseif ($this->isPassed()) {
            return 'passed';
        }
    }

}
