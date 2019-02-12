<?php

namespace App\Http\Controllers\User;

use App\User;
use App\FriendRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FriendRequestController extends Controller
{

    /**
     * Store New FriendRequest
     *
     * @param App\User $user
     * @return JSON
     */
    public function store(User $user)
    {
        auth()->user()->sentRequests()->create([
            'receiver_id' => $user->id,
        ]);

        return back();
    }

    /**
     * Delete FriendRequest
     *
     * @param App\FriendRequest $friendRequest
     * @return JSON
     */
    public function destroy(FriendRequest $friendRequest)
    {

        $friendRequest->delete();

        return back();
    }
}
