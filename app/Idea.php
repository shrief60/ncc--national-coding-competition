<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{


    /*************************************************************************/
    /*                              Relations                                */
    /*************************************************************************/
    public function users()
    {
        return $this->belongsToMany(User::class, 'progress');
    }

    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
