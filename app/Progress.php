<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{

    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The model table name
     *
     * @var string
     */
    protected $table = 'progress';


    /*************************************************************************/
    /*                              Relations                                */
    /*************************************************************************/
    public function user()
    {
        return $this->belongsTo(User::class);
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
