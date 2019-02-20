<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = [];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

}
