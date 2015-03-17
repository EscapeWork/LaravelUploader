<?php namespace EscapeWork\LaravelUploader\Services;

use Illuminate\Support\Str;

class SanitizeFilenameService
{

    public function execute($filename)
    {
        $pos       = strripos($filename, '.');
        $extension = substr($filename, ($pos + 1));

        $pos     = strripos($filename, '.');
        $newName = substr($filename, 0, $pos);

        $newName = Str::slug($newName) . '.' . $extension;

        return $newName;
    }

}
