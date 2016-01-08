<?php

namespace EscapeWork\LaravelUploader\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelUploaderServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->validator->extend(
            'mime_type_array',
            'EscapeWork\LaravelUploader\Validators\MimeTypeArrayValidator@validate'
        );
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
}
