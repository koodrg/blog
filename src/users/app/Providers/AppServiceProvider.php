<?php

namespace App\Providers;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Client::class, function () {
            return ClientBuilder::create()
                ->setHosts(config('elasticsearch.config'))
                ->build();
        });

        $this->app->bind(
            'App\Domain\User\Repositories\UserRepository',
            'App\Infrastructure\Repositories\UserRepository'
        );

        $this->app->bind(
            'App\Domain\UserNotificationSetting\Repositories\UserNotificationSettingRepositoryInterface',
            'App\Infrastructure\Repositories\UserNotificationSettingsRepository',
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
