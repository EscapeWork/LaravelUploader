<?php namespace EscapeWork\LaravelUploader\Commands;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Filesystem\Filesystem;
use EscapeWork\LaravelUploader\Services\ValidateFilenameService;

class MoveBulkFilesCommand extends Command implements SelfHandling
{

    protected $originDir;
    protected $targetDir;
    protected $files;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($originDir, $targetDir, $files)
    {
        $this->originDir = $originDir;
        $this->targetDir = $targetDir;
        $this->files     = !is_array($files) ? (array) $files : $files;
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle(ValidateFilenameService $validateFilename, Filesystem $filesystem)
    {
        $files = [];

        foreach ($this->files as $file) {
            $filename = $validateFilename->execute($this->targetDir, $file);

            $filesystem->move(
                $this->originDir . '/' . $file,
                $this->targetDir . '/' . $filename
            );

            $files[] = $filename;
        }

        return $files;
    }

}
