<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cog\Laravel\Love\Likeable\Models\Traits\Likeable;
use Cog\Contracts\Love\Likeable\Models\Likeable as LikeableContract;

class Comment extends Model implements LikeableContract
{

    use Likeable;

    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be appended.
     *
     * @var array
     */
    protected $appends = ['is_liked'];

    /*************************************************************************/
    /*                              Relations                                */
    /*************************************************************************/
    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class)->latest();
    }

    /*************************************************************************/
    /*                              Accessors                                */
    /*************************************************************************/

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->toFormattedDateString();
    }
/*
    public function getRoutesAttribute()
    {
        return [
            'replies' => route('learner.comments.replies', $this),
            'show' => route('learner.comments.update', $this),
            'likes' => route('learner.comments.likes', $this)
        ];
    }
*/
    public function getIsLikedAttribute()
    {
        return $this->liked;
    }

}
