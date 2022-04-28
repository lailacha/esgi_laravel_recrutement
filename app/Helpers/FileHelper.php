<?php


namespace App\Helpers;

class FileHelper
{
    public static function convertByteToKo($bytes)
    {
        return round($bytes / 1024, 2);
    }
}
