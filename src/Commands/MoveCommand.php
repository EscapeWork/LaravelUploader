<?php

namespace EscapeWork\LaravelUploader\Commands;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Contracts\Bus\SelfHandling;

class MoveCommand extends Command implements SelfHandling
{

    /**
     * Handle the command.
     *
     * @param  MediaSanitizeCommand  $command
     * @return void
     */
    public function handle($command, $next)
    {
        $command->files()->transform(function ($item) use ($command) {
            $item['file']->move($command->dir, $item['name']);

            return $item['name'];
        });

        return $next($command);
    }
}
