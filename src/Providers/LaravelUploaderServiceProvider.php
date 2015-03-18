<?php namespace EscapeWork\LaravelUploader\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelUploaderServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $root       = __DIR__ . '/../..';
        $configFile = 'laravel-uploader.php';

        $this->publishes([
            $root . '/config/' . $configFile => config_path($configFile),
        ]);

        $this->loadConfig();
        $this->loadValidators();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $root       = __DIR__ . '/../..';

        $this->mergeConfigFrom(
            $root . '/config/laravel-uploader.php', 'laravel-uploader'
        );
    }

    /**
     * Resolving validators
     * @return void
     */
    protected function loadValidators()
    {
        $this->app->validator->extend(
            'mime_type_array',
            'EscapeWork\LaravelUploader\Validators\MimeTypeArrayValidator@validate'
        );
    }


    /**
     * Setting config repository from config file
     * @return void
     */
    protected function loadConfig()
    {
        $this->app->bind('EscapeWork\LaravelUploader\Repositories\ConfigRepository', function () {
            new \EscapeWork\LaravelUploader\Repositories\ConfigRepository(config('laravel-uploader'));
        });

    }


}
