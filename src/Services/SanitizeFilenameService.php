<?php

namespace EscapeWork\LaravelUploader\Services;

use Illuminate\Support\Str;

class SanitizeFilenameService
{

    public function execute($filename)
    {
        $pos = strripos($filename, '.');

        if ($pos === 0) return '.' . Str::slug($filename);

        if ($pos === false) return Str::slug($filename);

        $extension = substr($filename, ($pos + 1));
        $pos       = strripos($filename, '.');
        $newName   = substr($filename, 0, $pos);
        $newName   = Str::slug($newName) . '.' . $extension;

        return $newName;
    }

}
