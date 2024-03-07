<?php

namespace Embit88\MultiLang\Providers;

use Embit88\MultiLang\Services\MultiLanguage;
use Illuminate\Support\ServiceProvider;
use MultiLanguage as Language;

class MultiLangServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('languages', function (){
            return new MultiLanguage();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        $this->mergeConfigFrom(__DIR__.'/../config/multilang.php', 'multilang');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../config/multilang.php' => config_path('multilang.php'),
        ], 'multilang');

        Language::start();

    }
}
