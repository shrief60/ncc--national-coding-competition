<?php

namespace App\Http\Controllers\User;

use App\Friend;
use App\FriendRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $user->load('friends', 'sentRequests.receiver', 'receivedRequests.sender');

        return view('teacher.friends', compact('user'));
    }

    public function store(User $user)
    {

        $friend = Auth::user();

        if ($user->friends()->wherePivot('user_id', $user->id)->exists()) {
            return back();
        }

        $data = [
            [
                'user_id' => $friend->id,
                'friend_id' => $user->id,
                'created_at' => Carbon::now(),
            ],
            [
                'user_id' => $user->id,
                'friend_id' => $friend->id,
                'created_at' => Carbon::now(),
            ],
        ];

        Friend::insert($data);

        FriendRequest::where([
            'sender_id' => $user->id,
            'receiver_id' => $user->id,
        ])->orWhere([
            'sender_id' => $user->id,
            'receiver_id' => $user->id,
        ])->delete();

        return back();

    }

    public function destroy(User $user)
    {

        $friend = Auth::user();

        Friend::where([
            'user_id' => $friend->id,
            'friend_id' => $user->id,
        ])->orWhere([
            'user_id' => $user->id,
            'friend_id' => $friend->id,
        ])->delete();

        return back();

    }
}
