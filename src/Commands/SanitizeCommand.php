<?php namespace EscapeWork\Manager\Medias\Commands;

use EscapeWork\Manager\Medias\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Str;

class SanitizeCommand extends Command implements SelfHandling {

    /**
     * Handle the command.
     *
     * @param  MediaSanitizeCommand  $command
     * @return void
     */
    public function handle($command, $next)
    {
        $command->files()->transform(function($item) {
            return [
                'name' => SanitizeCommand::toFilename($item['name']), 
                'file' => $item['file'],
            ];
        });

        return $next($command);
    }

    public static function toFilename($name)
    {
        $pos       = strripos($name, '.');
        $extension = substr($name, ($pos + 1));

        $pos     = strripos($name, '.');
        $newName = substr($name, 0, $pos);

        $newName = Str::slug($newName) . '.' . $extension;

        return $newName;
    }
}
