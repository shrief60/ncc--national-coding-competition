<?php

namespace App\Http\Controllers\judge;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Round;
use App\Progress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProgressController extends Controller
{
    public function index()
    {
        $submissions = Progress::all();
        $rounds      = Round::all();
        return view('judge.submissions.index', compact('rounds' , 'submissions'));
    }
   /* public function winner (Request $request ){
        $validator = validator::make($request->all(), [

            'roundId' => 'required',
            'winner' => 'required',
        ])->validate();
        $round = Progress::where('id' , $request)

    }*/
    public function show(Progress $sub){
        return view('judge.submissions.submission' , compact('sub'));
    }

}
