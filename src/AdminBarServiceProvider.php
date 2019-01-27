<?php

// todo@shira: shrftもnamespaceにいれたほうがいい
namespace Shrft\AdminBar;
use AdminBar\Middleware\AdminBarMiddleware;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;

class AdminBarServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/adminbar.php', 'adminbar'
        );
    }
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMiddleware(AdminBarMiddleware::class);

       $this->loadViewsFrom(__DIR__ . '/../resources/views', 'adminbar');
        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/adminbar'),
        ], 'public');
        $this->publishes([
            __DIR__ . '/../config/adminbar.php' => config_path('adminbar.php'),
        ]);



    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
    }
    /**
     * Register the Debugbar Middleware
     *
     * @param  string $middleware
     */
    protected function registerMiddleware($middleware)
    {
        $kernel = $this->app[Kernel::class];
        $kernel->pushMiddleware($middleware);
    }
}
