<?php
namespace App\Classes;

use DomDocument;
use Intervention\Image\Facades\Image;

class TextEditor
{
    public static function create($src, $path)
    {
        $dom = new DomDocument();
        $dom->loadHtml($src, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            // if the img source is 'data-url'
            if (preg_match('/data:image/', $src)) {
                // Generating a random filename
                $filename = uniqid();
                // Relative path from public folder
                $relativePath = "/storage/$path/$filename.jpg";

                $directoryName = public_path("/storage/$path/");
                //Check if the directory already exists.
                if (!is_dir($directoryName)) {
                    // dd($directoryName);
                    //Directory does not exist, so lets create it.
                    mkdir($directoryName, 0755, true);
                }
                // Create an image using ImageIntervention
                Image::make($src)
                    ->resize(300, null, function ($constraints) {
                        $constraints->aspectRatio();
                        $constraints->upsize();
                    })
                    ->encode('jpg', 100)
                    ->save(public_path($relativePath));
                // Replace old src by new src
                $new_src = asset($relativePath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }
        }
        return htmlspecialchars($dom->saveHTML(), ENT_NOQUOTES);
    }
}
