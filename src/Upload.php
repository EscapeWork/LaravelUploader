<?php

namespace EscapeWork\LaravelUploader;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Contracts\Bus\Dispatcher;
use EscapeWork\LaravelUploader\Jobs\UploadJob;
use EscapeWork\LaravelUploader\Exceptions\UploadSettingsException;

class Upload
{

    /**
     * @trait Illuminate\Foundation\Bus\DispatchesJobs
     */
    use DispatchesJobs;

    /**
     * @var Illuminate\Contracts\Bus\Dispatcher
     */
    private $dispatcher;

    private $dir;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
        $this->dir = './storage/app/upload';
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
            'EscapeWork\LaravelUploader\Jobs\NormalizeJob',
            'EscapeWork\LaravelUploader\Jobs\ValidateJob',
            'EscapeWork\LaravelUploader\Jobs\MoveJob',
        ]);

        $dispatched = $this->dispatch(new UploadJob($files, $this->dir));
        $this->dispatcher->pipeThrough([]);

        return $dispatched;
    }
}
