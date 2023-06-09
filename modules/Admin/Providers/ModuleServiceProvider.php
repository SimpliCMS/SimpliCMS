<?php

namespace Modules\Admin\Providers;

use Konekt\Concord\BaseModuleServiceProvider;
use Konekt\AppShell\Providers\SettingsProvider;
use Modules\Admin\Http\Requests\CreateMedia;
use Schema;

class ModuleServiceProvider extends BaseModuleServiceProvider {

    /**
     * The namespace for the module's models.
     *
     * @var string
     */
    protected $modelNamespace = 'Modules\Admin\Models';
    protected $requests = [
        CreateMedia::class,
    ];

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot() {


//        $this->app->bind(AppShellProvider::class, AppShellServiceProvider::class);
        $this->app->bind(SettingsProvider::class, AdminSettingsServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(PluginServiceProvider::class);
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
        $this->app->concord->registerModule(\Konekt\AppShell\Providers\ModuleServiceProvider::class,
                $config = [
            'migrations' => true,
            'ui' => [
                'name' => 'SimpliCMS',
                'url' => '/admin'
            ]
                ]
        );
    }

}
