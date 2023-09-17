<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileHelper {
    public static function formatName($filename): string {
        return time() . '_' .str_replace(' ','_', $filename);
    }

    /**
     * store file in storage and return file name
     * @param UploadedFile $image
     * @param string $folderName folder name to store file. Leave empty to store in public folder
     * @return \Illuminate\Http\JsonResponse|string
     */
    public static function upload(UploadedFile $image, string $folderName = '') {
        try{
            $imageName = $folderName."/" . self::formatName($image->getClientOriginalName());

            // Store the résumé in the 'public' disk (storage/app/public)
            Storage::disk('public')->put($imageName, file_get_contents($image));

            return $imageName;
        }
        catch (\Exception) {
            return GlobalHelper::error('Could not upload file');
        }

    }
}

