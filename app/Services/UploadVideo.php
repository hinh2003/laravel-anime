<?php

namespace App\Services;

class UploadVideo
{
    private $uploadUrl = 'http://up.hydrax.net/c63a6715ad81a4512b1bac5458496fc4';

    public function upload($filePath)
    {
        if (!file_exists($filePath)) {
            return ['error' => 'File không tồn tại!'];
        }

        $fileName = basename($filePath);
        $cfile = new \CURLFile($filePath, mime_content_type($filePath), $fileName);
        $post = ['file' => $cfile];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->uploadUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }
}
