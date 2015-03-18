<?php namespace EscapeWork\LaravelUploader;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Contracts\Bus\Dispatcher;
use EscapeWork\LaravelUploader\Commands\UploadCommand;
use EscapeWork\LaravelUploader\Exceptions\UploadSettingsException;
use EscapeWork\LaravelUploader\Repositories\ConfigRepository;

class Upload
{

    use DispatchesCommands;

    private $dispatcher;
    private $dir;

    public function __construct(Dispatcher $dispatcher, ConfigRepository $config)
    {
        $this->dispatcher = $dispatcher;
        $this->dir        = $config->dir;
    }

    public function to($dir)
    {
        $this->dir = $dir;

        return $this;
    }

    public function execute($files)
    {
        if (empty($this->dir)) throw new UploadSettingsException;

        $this->dispatcher->pipeThrough([
            'EscapeWork\LaravelUploader\Commands\NormalizeCommand',
            'EscapeWork\LaravelUploader\Commands\ValidateCommand',
            'EscapeWork\LaravelUploader\Commands\MoveCommand',
        ]);

        $dispatched = $this->dispatch(new UploadCommand($files, $this->dir));
        $this->dispatcher->pipeThrough([]);

        return $dispatched;
    }
}
