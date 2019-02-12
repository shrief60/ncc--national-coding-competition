<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{


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
}
