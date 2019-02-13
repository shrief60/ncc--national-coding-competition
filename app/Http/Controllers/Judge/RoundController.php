<?php

namespace App\Http\Controllers\judge;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Round ;
use App\Progress ;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class RoundController extends Controller
{
    public function create(){
        return  view('judge.rounds.create');
    }
    public function store (Request $request){
        $validator = validator::make($request->all(), [

            'roundName' => 'required',
            'duedate' => 'required',
        ])->validate();
        $round  = new Round();
        $round->name = $request->roundName ;
        $round->due_date = $request->duedate;
        $round->started = 0 ;
        $round->save();
        return back();
    }
    public function edit(Round $round){
       // $round = Round::find(4);
        //dd($round);
        return view ('judge.rounds.edit' , compact('round'));
    }
    public function update( Request $request  , Round $round ){
        $validator = validator::make($request->all(), [
            'roundName' => 'required',
            'duedate' => 'required',
        ])->validate();

        $round->due_date = $request->duedate;
        $round->save();

        return back();
    }

}
