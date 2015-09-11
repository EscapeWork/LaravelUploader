<?php

namespace EscapeWork\LaravelUploader\Providers;

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
        $this->loadValidators();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
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


}
