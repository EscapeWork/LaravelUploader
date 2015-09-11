<?php

namespace EscapeWork\LaravelUploader\Commands;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Contracts\Bus\SelfHandling;
use EscapeWork\LaravelUploader\Collections\UploadCollection;

class NormalizeCommand extends Command implements SelfHandling
{

    private $collection;

    public function __construct(UploadCollection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * Handle the command.
     *
     * @param  MediaSanitizeCommand  $command
     * @return void
     */
    public function handle($command, $next)
    {
        $files = $this->parseFilesIntoArray($command->files());

        $this->normalizeFiles($files);

        $command->files($this->collection);

        return $next($command);
    }

    private function parseFilesIntoArray($files)
    {
        return $files instanceof UploadedFile ? [$files] : $files;
    }

    private function normalizeFiles(array $files)
    {
        $sanitize = app('EscapeWork\LaravelUploader\Services\SanitizeFilenameService');

        foreach ($files as $file) {
            $filename = $sanitize->execute($file->getClientOriginalName());
            $this->collection->push([
                'name' => $filename,
                'file' => $file,
            ]);
        }
    }

}
