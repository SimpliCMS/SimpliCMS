<?php

namespace Modules\Core\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Modules\Core\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot() {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map() {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAdminWebRoutes();
        //
    }

    /**
     * Define the Admin "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminWebRoutes() {
        Route::prefix('admin')
                ->middleware('web', 'auth', 'role:admin')
                ->namespace($this->namespace)
                ->group(base_path('modules/Core/resources/routes/admin.php'));
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes() {
        Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('modules/Core/resources/routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes() {
        Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('modules/Core/resources/routes/api.php'));
    }

}