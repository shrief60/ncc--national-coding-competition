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
    public function idea()
    {
        return $this->belongsTo(Idea::class);
    }
    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }



    /*************************************************************************/
    /*                              Methods                                  */
    /*************************************************************************/
    public static function isIdeaFinished($userId, $ideaId)
    {
        return self::where([
            'user_id' => $userId,
            'idea_id' => $ideaId,
            'finished' => true,
        ])->exists();
    }

    public static function isRoundFinished($userId, $roundId)
    {
        return self::where([
            'user_id' => $userId,
            'round_id' => $roundId,
            'finished' => true,
        ])->exists();
    }

}
