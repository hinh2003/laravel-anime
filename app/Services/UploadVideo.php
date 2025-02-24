<?php

namespace App\Services;

class UploadVideo
{
    private $uploadUrl;

    public function __construct()
    {
        $this->uploadUrl = config('services.hydrax_upload_url');
    }

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
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            return ['error' => $error];
        }

        return json_decode($result, true) ?: ['error' => 'Không thể decode JSON từ response!'];
    }
}
