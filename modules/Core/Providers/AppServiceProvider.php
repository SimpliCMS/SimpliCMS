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
        // Load default modules
        $this->app->concord->registerModule(\Modules\Admin\Providers\ModuleServiceProvider::class);
        $this->app->concord->registerModule(\Modules\User\Providers\ModuleServiceProvider::class);

        // Dynamically load additionally installed modules
        $modulesPath = base_path('modules');
        $moduleProviders = [];

        // Scan the modules folder
        if (is_dir($modulesPath)) {
            $directories = scandir($modulesPath);
            foreach ($directories as $directory) {
                if ($directory === 'Core' || $directory === 'Admin' || $directory === 'User') {
                    continue;
                }
                if ($directory !== '.' && $directory !== '..' && is_dir($modulesPath . '/' . $directory)) {
                    // Create the namespace for the module service provider
                    $namespace = "\\Modules\\{$directory}\\Providers\\ModuleServiceProvider";

                    // Check if the module service provider class exists
                    if (class_exists($namespace)) {
                        // Add the module service provider to the array
                        $moduleProviders[] = $namespace;
                    }
                }
            }
        }

        // Register the module service providers with Concord
        foreach ($moduleProviders as $moduleProvider) {
            $this->app->concord->registerModule($moduleProvider);
        }
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
