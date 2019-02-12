<?php

namespace App\Http\Controllers\Learner;

use App\Classes\TextEditor;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Category;

class CategoriesController extends Controller
{
    function  show(Request $request){
        return view('learner.categories.create');
    }
    function store(Request $request){
        $validator = validator::make($request->all(), [
            'body' => 'required',
        ]);
        $category = Category::create([
            'body' => $request->body,
        ]);
        return back();
    }
}
