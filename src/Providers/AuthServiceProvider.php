<?php

namespace Tots\Auth\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Tots\Auth\Guards\AuthGuard;
use Tots\Auth\Services\AuthService;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register migrations
        if($this->app->runningInConsole()){
            $this->registerMigrations();
        }
        //
        $this->app->singleton(AuthService::class, function ($app) {
            return new AuthService(config('auth'));
        });
    }
    /**
     * Register migrations library
     *
     * @return void
     */
    protected function registerMigrations()
    {
        $mainPath = database_path('migrations');
        $paths = array_merge([
            './vendor/tots/auth-lumen/database/migrations'
        ], [$mainPath]);
        $this->loadMigrationsFrom($paths);
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        Auth::provider('custom', function ($app, array $config) {
            return new TotsUserProvider();
        });

        Auth::extend('custom', function ($app, $name, array $config) {
            return new AuthGuard(Auth::createUserProvider($config['provider']), $app->make('request'), $app->make(AuthService::class));
        });
    }
}
