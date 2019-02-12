<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{


    /*************************************************************************/
    /*                              Relations                                */
    /*************************************************************************/
    public function users()
    {
        return $this->belongsToMany(User::class, 'progress');
    }

    public function ideas()
    {
        return $this->hasMany(Idea::class);
    }

}
