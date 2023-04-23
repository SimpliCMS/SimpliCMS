<?php

namespace Modules\Admin\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider {

    /**
     * The namespace for the module's models.
     *
     * @var string
     */
    protected $modelNamespace = 'Modules\Admin\Models';

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot() {
        $this->app->concord->registerModule(\Konekt\AppShell\Providers\ModuleServiceProvider::class,
                $config = [
            'ui' => [
                'name' => 'Vanilo',
                'url' => '/admin'
            ]
                ]
        );
        $this->app->register(RouteServiceProvider::class);
        $this->adminViewPaths();
        $this->appshellViewPaths();
    }

    public function adminViewPaths() {
        $moduleLower = lcfirst('Admin');
        $currentTheme = 'admin';
        $views = [
            module_Viewpath('Admin', $currentTheme),
            base_path("themes/$currentTheme/views/modules/Admin"),
        ];

        return $this->loadViewsFrom($views, $moduleLower);
    }

    public function appshellViewPaths() {
        $currentTheme = 'admin';
        $views = [
            module_Viewpath('Admin', $currentTheme),
            base_path("themes/$currentTheme/views/modules/Admin"),
        ];

        return $this->loadViewsFrom($views, 'appshell');
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register() {
        // Your module's register logic here
    }

}
