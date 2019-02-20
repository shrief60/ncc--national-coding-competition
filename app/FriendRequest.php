<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{

    /**
     * Specify the table name that related to this model
     *
     * @var string
     */
    protected $table = 'friends_request';

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
