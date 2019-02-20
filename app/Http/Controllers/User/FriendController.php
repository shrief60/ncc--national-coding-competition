<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Friend;
use Carbon\Carbon;
use App\FriendRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $user->load('friends', 'sentRequests.receiver', 'receivedRequests.sender');

        return view('user.friends.index', compact('user'));
    }

    public function store(User $user)
    {

        $friend = Auth::user();

        if ($user->friends()->wherePivot('user_id', $user->id)->exists()) {
            return back();
        }

        $user->friends()->attach($friend);

        $friend->friends()->attach($user);


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

        $user->friends()->detach($friend);

        $friend->friends()->detach($user);

        return back();

    }
}
