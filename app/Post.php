<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cog\Contracts\Love\Likeable\Models\Likeable as LikeableContract;
use Cog\Laravel\Love\Likeable\Models\Traits\Likeable;


class Post extends Model implements LikeableContract
{
    use Likeable;

    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = [];


    /*************************************************************************/
    /*                              Relations                                */
    /*************************************************************************/
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function category()
    {
        return $this->belongsTo(category::class);
    }

    /*************************************************************************/
    /*                              Accessors                                */
    /*************************************************************************/
    public function getBodyAttribute($body)
    {
        return htmlspecialchars_decode($body);
    }
}
