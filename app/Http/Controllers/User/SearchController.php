<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{


    public function user(Request $request)
    {
        $user = null;
        $status = null;

        if (!$request->filled('term')) {
            return api(compact('user', 'status'));
        }

        $user = User::whereEmail($request->term)->first();
        $user = auth()->user();


        // Email doesn't exist
        if (is_null($user)) {
            return api(compact('user', 'status'));
        }

        if ($user->receivedRequests()->where('sender_id', $user->id)->exists()) {
            $status = 'receiver';
        } elseif ($user->sentRequests()->where('receiver_id', $user->id)->exists()) {
            $status = 'sender';
        } elseif ($user->friends()->wherePivot('user_id', $user->id)->exists()) {
            $status = 'friend';
        }

        return api(compact('user', 'status'));
    }
}
