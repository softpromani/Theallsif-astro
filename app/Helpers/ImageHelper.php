<?php

namespace App\Helpers;

class ImageHelper
{
    public static function uploadImage($file, $prefix = null, $folder = null)
    {
        $empic = $prefix ?? 'image';
        $empic .= '-' . time() . '-' . rand(0, 99) . '.' . $file->extension();
        $file->storeAs('public/upload/' . $folder, $empic);
        return [
            'storage' => 'local',
            'image_name' => $empic,
            'path' => 'upload/' . $folder . '/',
            'size' => $file->getSize(),
        ];
    }
}
