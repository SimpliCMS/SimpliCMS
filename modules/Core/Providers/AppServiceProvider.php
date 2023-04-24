<?php

namespace Modules\Core\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Schema;
use Menu;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Schema::defaultStringLength(191);
        if (Str::startsWith(config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }

        $this->app->concord->registerModel(\Konekt\User\Contracts\User::class, \Modules\User\Models\User::class);
//        $this->app->register(MenuServiceProvider::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
