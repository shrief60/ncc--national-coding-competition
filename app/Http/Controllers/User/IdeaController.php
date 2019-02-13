<?php

namespace App\Http\Controllers\User;

use App\Idea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{

    public function show(Idea $idea)
    {

        return $idea;

        $round = Round::with('ideas')->get();

        return view('users.ideas.show', compact('idea', 'rounds'));
    }

    /**
     * This function will add user to an idea
     *
     * @param Idea $idea
     * @return void
     */
    public function store(Idea $idea)
    {

        $idea->addNewUser();

        $route = route('user.attachments.store', $idea);

        return api(compact('idea', 'route'));
    }

    public function update(Idea $idea)
    {

    }
}
