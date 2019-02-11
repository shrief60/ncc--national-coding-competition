<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function __invoke($lang)
    {

        session(['app_locale' => $lang]);

        return Redirect::back();
    }
}
