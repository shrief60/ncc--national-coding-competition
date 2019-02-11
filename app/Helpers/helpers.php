<?php

if (!function_exists('api')) {

    function api($array, $status = 200)
    {

        return response()->json($array, $status);
    }
}

if (!function_exists('getImageIcon')) {

    function getImageIcon($path, $ext = 'png')
    {
        return asset("/images/icons/$path.$ext");
    }
}

if (!function_exists('icon')) {

    function icon($path, $ext = 'png')
    {
        return asset("/images/icons/$path.$ext");
    }
}

if (!function_exists('img')) {

    function img($path, $ext = 'png')
    {
        return asset("/images/$path.$ext");
    }
}

if (!function_exists('css')) {

    function css($path)
    {
        return "<link rel='stylesheet' href=" . asset("/css/$path.css") . ">";
    }
}

if (!function_exists('js')) {

    function js($path)
    {
        return "<script src=" . asset("/js/$path.js") . "></script>";
    }
}



if (!function_exists('locale')) {

    function locale()
    {
        return app()->getLocale();
    }
}


if(!function_exists('isJson'))
{
    function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}
