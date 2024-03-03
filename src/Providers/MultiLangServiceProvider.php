<?php

namespace Embit88\MultiLang\Providers;

use Embit88\MultiLang\Services\MultiLanguage;
use Illuminate\Support\ServiceProvider;

class MultiLangServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        MultiLanguage::getInstance()->start();

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../config/multilang.php' => config_path('multilang.php'),
        ]);
    }
}
