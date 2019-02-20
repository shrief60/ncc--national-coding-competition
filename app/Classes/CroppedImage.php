<?php

namespace App\Classes;

use Intervention\Image\Facades\Image;

class CroppedImage
{
    public static function create($uploadedImage, $path, $name)
    {
        $image = Image::make($uploadedImage->getRealPath());

        $min = min($image->width(), $image->height());

        $image->crop($min, $min, $min == $image->width() ? 0 : round($min / 4), $min == $image->height() ? 0 : round($min / 4));

        $path = public_path("storage/$path");

        return $image->save("{$path}/{$name}") ? true : false;

    }
}
