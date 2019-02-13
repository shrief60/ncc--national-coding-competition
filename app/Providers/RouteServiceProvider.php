<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapUserRoutes();

        $this->mapJudgeRoutes();

        $this->mapAdminRoutes();

        $this->mapAuthRoutes();
    }


    /**
     * Define the "admin" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::middleware(['web', 'admin', 'auth:admin'])
            ->name('admin.')
            ->prefix('admin')
            ->namespace("$this->namespace\Admin")
            ->group(base_path('routes/admin.php'));
    }

    /**
     * Define the "judge" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapJudgeRoutes()
    {
        Route::middleware(['web', 'judge', 'auth:judge'])
            ->name('judge.')
            ->prefix('judge')
            ->namespace("$this->namespace\Judge")
            ->group(base_path('routes/judge.php'));
    }

    /**
     * Define the "user" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapUserRoutes()
    {
        Route::middleware(['web', 'auth'])
            ->name('user.')
            ->namespace("$this->namespace\User")
            ->group(base_path('routes/user.php'));
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace("$this->namespace\General")
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    /**
     * Define the "auth" routes for the application
     *
     * These routes for handling authentication
     *
     * @return void
     */
    protected function mapAuthRoutes()
    {
        Route::middleware('web')
             ->namespace("$this->namespace\Auth")
             ->group(base_path('routes/auth.php'));
    }

}
