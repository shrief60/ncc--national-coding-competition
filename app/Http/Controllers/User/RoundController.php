<?php

namespace App\Http\Controllers\User;

use App\Round;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RoundController extends Controller
{

    public function index()
    {

        $rounds = Round::with('ideas')->get();

        $user = Auth::user()->load(['ideas.round.attachments' => function($query) {
            $query->userAttachments()->get();
        }]);


        return view('user.pages.home', compact('rounds', 'user'));
    }

}
