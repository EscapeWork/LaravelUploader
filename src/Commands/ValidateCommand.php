<?php

namespace EscapeWork\LaravelUploader\Commands;

use Illuminate\Contracts\Bus\SelfHandling;

class ValidateCommand extends Command implements SelfHandling
{

    /**
     * Handle the command.
     *
     * @param  MediaValidateCommand  $command
     * @return void
     */
    public function handle($command, $next)
    {
        $command->files()->transform(function ($item) use ($command) {
            $validateService = app('EscapeWork\LaravelUploader\Services\ValidateFilenameService');

            return [
                'name' => $validateService->execute($command->dir, $item['name']),
                'file' => $item['file'],
            ];
        });

        return $next($command);
    }
}
