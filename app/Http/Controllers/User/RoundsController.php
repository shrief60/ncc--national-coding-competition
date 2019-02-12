<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class RoundsController extends Controller
{
    public function index()
    {
        return view('learner.rounds.round');
    }
    public function indexToIdea()
    {
        return view('learner.rounds.idea');
    }
    public function indexToIdea2()
    {
        return view('learner.rounds.idea2');
    }
}
