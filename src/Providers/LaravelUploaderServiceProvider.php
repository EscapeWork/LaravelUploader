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
        dd('uploader provider');
        $configFile = 'laravel-uploader.php';
        $root       = __DIR__ . '/../..';
        dd($root . '/config/' . $configFile);
        $this->publishes([
            $root . '/config/' . $configFile => config_path($configFile),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $root       = __DIR__ . '/../..';
        dd($root . '/config/laravel-uploader.php');
        $this->mergeConfigFrom(
            $root . '/config/laravel-uploader.php', 'laravel-uploader'
        );
    }

}
