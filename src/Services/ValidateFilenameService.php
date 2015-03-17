<?php namespace EscapeWork\LaravelUploader\Services;

class ValidateFilenameService
{

    public function execute($basepath, $filename)
    {
        $filesystem = app('Illuminate\Filesystem\Filesystem');

        $path      = $basepath . '/' . $filename;
        $extension = $filesystem->extension($filename);
        $filename  = str_replace('.' . $extension, null, $filename);

        $count = 0;
        while ($filesystem->exists($path)) {
            $count++;
            $path  = $basepath . '/' . $filename . '-' . $count . '.' . $extension;
        }

        if ($count === 0) return $filename . '.' . $extension;

        return $filename . '-' . $count . '.' . $extension;
    }

}
