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

        $user = Auth::user()->load('ideas.round');

        return view('user.pages.home', compact('rounds', 'user'));
    }

    public function show(Round $round)
    {
        return view('user.rounds.show');
    }
}
