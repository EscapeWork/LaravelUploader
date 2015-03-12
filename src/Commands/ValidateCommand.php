<?php namespace EscapeWork\LaravelUploader\Commands;

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
            $count = $separator = null;
            $filename = $item['name'];

            while (is_file($command->dir . '/' . $count . $separator . $filename)) {
                $separator = '-';
                $count++;
            }
            $filename = $count . $separator . $filename;

            return [
                'name' => $filename,
                'file' => $item['file'],
            ];
        });

        return $next($command);
    }
}
