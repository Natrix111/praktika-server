<?php

namespace Services;

class ImageService
{
    public static function upload(array $file, string $uploadDir = '/public/images/'): ?string
    {
        if (empty($file['tmp_name'])) {
            return null;
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $ext;
        $fullPath = $_SERVER['DOCUMENT_ROOT'] . $uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $fullPath)) {
            return $uploadDir . $filename;
        }

        return null;
    }
}