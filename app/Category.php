<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
