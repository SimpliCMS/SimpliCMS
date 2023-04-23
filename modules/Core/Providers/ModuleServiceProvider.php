<?php

namespace Modules\Core\Providers;

use Konekt\Concord\BaseBoxServiceProvider;
use Illuminate\Support\Facades\DB;
use Schema;

class ModuleServiceProvider extends BaseBoxServiceProvider {

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot() {
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

        $this->ViewPaths();
        $this->adminViewPaths();
    }

    public function ViewPaths() {
        $moduleLower = lcfirst('Core');
        if (Schema::hasTable('settings')) {
            $setting = DB::table('settings')->where('id', 'site.theme')->first();

            if ($setting) {
                $currentTheme = $setting->value;
            } else {
                $currentTheme = 'default';
            }
        } else {
            $currentTheme = 'default';
        }
        $views = [
            module_Viewpath('Core', $currentTheme),
            base_path("themes/$currentTheme/views/modules/Core"),
            module_Viewpath('Core', 'default'),
            base_path("themes/default/views/modules/Core"),
            base_path("resources/views/modules/Core"),
        ];

        return $this->loadViewsFrom($views, $moduleLower);
    }

    public function adminViewPaths() {
        $moduleLower = lcfirst('Core');
        $currentTheme = 'admin';
        $views = [
            module_Viewpath('Core', $currentTheme),
            base_path("themes/$currentTheme/views/modules/Core"),
        ];

        return $this->loadViewsFrom($views, $moduleLower . '-admin');
    }

}
