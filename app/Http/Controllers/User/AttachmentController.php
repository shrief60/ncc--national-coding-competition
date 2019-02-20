<?php

namespace App\Http\Controllers\User;

use App\Idea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AttachmentController extends Controller
{

    public function store(Request $request, Idea $idea)
    {

        $user = Auth::user();

        $attachment = [];

        foreach($request->attachments as $attachment)
        {
            $attachments[] = [
                'user_id' => Auth::id(),
                'type' => detect_type($attachment->getMimeType()),
                'path' => $attachment->store("{$idea->round->name}/{$user->username}", 'public'),
                'name' => $attachment->getClientOriginalName()
            ];
        }

        $idea->round->attachments()->createMany($attachments);

        return back();
    }
}
