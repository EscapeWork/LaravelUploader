<?php namespace EscapeWork\LaravelUploader\Commands;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Contracts\Bus\SelfHandling;
use EscapeWork\LaravelUploader\Collections\UploadCollection;

class NormalizeCommand extends Command implements SelfHandling {
    
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
        if ($files instanceof UploadedFile) {
            $files = [$files];
        }

        return $files;
    }

    private function normalizeFiles(array $files)
    {
        foreach ($files as $file) {
            $this->collection->push([
                'name' => $file->getClientOriginalName(),
                'file' => $file
            ]);
        }
    }

}
