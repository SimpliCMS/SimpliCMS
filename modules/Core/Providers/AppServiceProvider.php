<?php

namespace Modules\Core\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Modules\Core\Helpers\Helper;
use Modules\Core\Helpers\MediaUrlGenerator;
use Spatie\MediaLibrary\Support\UrlGeneratorFactory;
use Schema;
use Menu;
use Blade;

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
        $this->app->concord->registerModel(\Konekt\User\Contracts\Profile::class, \Modules\Profile\Models\Profile::class);
        $this->app->concord->registerModel(\Konekt\Address\Contracts\Person::class, \Modules\Profile\Models\Person::class);
//        $this->app->alias(Helper::class, 'Core');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        // Override the default URL generator with your custom implementation

    }

}
