<?php

namespace App\Helpers;

class FileHelper {
    public static function formatName($filename): string {
        return time() . '_' .str_replace(' ','_', $filename);
    }
}

