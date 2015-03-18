<?php namespace EscapeWork\LaravelUploader\Repositories;

class ConfigRepository
{
    public function __construct(array $configs)
    {
        $this->objectifyArray($configs, $this);
    }

    protected function objectifyArray(array $configs, $context)
    {
        foreach ($configs as $key => $config) {
            if (! $this->isNewContext($config)) {
                $context->{$key} = $config;
                continue;
            }

            $context->{$key} = new \StdClass;
            $this->objectifyArray($config, $context->{$key});
        }
    }


    private function isNewContext($config)
    {
        return is_array($config) && $config !== array_values($config);
    }
}