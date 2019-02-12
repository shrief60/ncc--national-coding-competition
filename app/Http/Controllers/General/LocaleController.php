<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;

class LocaleController extends Controller
{

    /**
     * Change App Locale
     *
     * @param String $locale
     * @return redirect
     */
    public function __invoke(String $locale)
    {

        if(in_array($locale, config('app.locales'))) {
            session(['app_locale' => $locale]);
        }

        return back();
    }
}
