<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Register API routes
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->app->getNamespace())
            ->group(base_path('routes/api.php'));

        // Register web routes
        Route::middleware('web')
            ->namespace($this->app->getNamespace())
            ->group(base_path('routes/web.php'));
    }
}
