<?php namespace EscapeWork\LaravelUploader\Services;

use Illuminate\Filesystem\Filesystem;

class ValidateFilenameService
{
    protected $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function execute($basepath, $filename)
    {
        $path      = $basepath . '/' . $filename;
        $extension = $this->filesystem->extension($filename);

        $filename  = str_replace('.' . $extension, null, $filename);

        $count = 0;

        while ($this->filesystem->exists($path)) {
            $count++;
            $path  = $basepath . '/' . $filename . '-' . $count . '.' . $extension;
        }

        if ($count === 0) return $filename . '.' . $extension;

        return $filename . '-' . $count . '.' . $extension;
    }

}
