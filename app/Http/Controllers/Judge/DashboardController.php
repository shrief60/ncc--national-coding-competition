<?php

namespace App\Http\Controllers\judge;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function  index(){
        return view ('judge.dashboard.dashboard');
    }
}
