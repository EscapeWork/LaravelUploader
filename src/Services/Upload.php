<?php namespace EscapeWork\LaravelUploader\Services;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Contracts\Bus\Dispatcher;
use EscapeWork\Manager\Medias\Commands\UploadCommand;
use EscapeWork\Manager\Medias\Exceptions\MediaSettingsException;

class Upload {

    use DispatchesCommands;

    private $dispatcher;
    private $dir;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
        $this->dir        = config('laravel-uploader.dir');
    }

    public function to($dir)
    {
        $this->dir = $dir;

        return $this;
    }

    public function start($files)
    {
        if (! $this->dir) {
            throw new UploadSettingsException;
        }

        $this->dispatcher->pipeThrough([
            'EscapeWork\Manager\Medias\Commands\NormalizeCommand',
            'EscapeWork\Manager\Medias\Commands\SanitizeCommand',
            'EscapeWork\Manager\Medias\Commands\ValidateCommand',
            'EscapeWork\Manager\Medias\Commands\MoveCommand',
        ]);

        $dispatched = $this->dispatch(
            new UploadCommand($files, $this->dir)
        );

        $this->dispatcher->pipeThrough([]);

        return $dispatched;
    }
}
