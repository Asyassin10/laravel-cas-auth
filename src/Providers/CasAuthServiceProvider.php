<?php

namespace YassineAs\CasAuth\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use YassineAs\CasAuth\CasAuthManager;
use YassineAs\CasAuth\Services\ApiService;
use YassineAs\CasAuth\Http\Middleware\CasAuth;
use YassineAs\CasAuth\Http\Controllers\CasAuthController;

class CasAuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/cas.php', 'cas');

        $this->app->singleton('cas-auth', fn ($app) => new CasAuthManager($app));
        $this->app->singleton(ApiService::class, fn () => new ApiService());
    }

    public function boot(): void
    {
        $this->registerPublishing();
        $this->registerMiddleware();
        $this->registerRoutes();
    }

    protected function registerPublishing(): void
    {
        $this->publishes([
            __DIR__ . '/../config/cas.php' => config_path('cas.php'),
        ], 'cas-config');
    }

    protected function registerMiddleware(): void
    {
        $this->app['router']->aliasMiddleware('cas.auth', CasAuth::class);
    }

    protected function registerRoutes(): void
    {
        Route::group($this->routeConfiguration(), function () {
            Route::get('login', [CasAuthController::class, 'login'])->name('login');
            Route::get('/cas/callback', [CasAuthController::class, 'handleCallback'])->name('cas.callback');
            Route::post('/logout', [CasAuthController::class, 'logout'])->name('logout');
        });
    }

    protected function routeConfiguration(): array
    {
        return [
            'middleware' => 'web',
            'prefix'     => config('cas.route_prefix', ''),
            'as'         => config('cas.route_name_prefix', ''),
        ];
    }
}
