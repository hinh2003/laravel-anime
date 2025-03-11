<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class UploadImage
{

    public function upload(UploadedFile $file, $folder)
    {
        $originalName = $file->getClientOriginalName();
        $path = $file->move(public_path("frontend/$folder"), $originalName);

        return "frontend/$folder/" . $originalName;
    }
}
