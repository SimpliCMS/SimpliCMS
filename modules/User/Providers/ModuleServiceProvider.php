<?php

namespace Modules\User\Providers;

use Konekt\Concord\BaseModuleServiceProvider;
use Illuminate\Support\Facades\DB;
use Schema;

class ModuleServiceProvider extends BaseModuleServiceProvider {

    /**
     * The namespace for the module's models.
     *
     * @var string
     */
    protected $modelNamespace = 'Modules\User\Models';

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot() {
        parent::boot();
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(AdminMenuServiceProvider::class);
        $this->app->register(PluginServiceProvider::class);
        $this->ViewPaths();
        $this->adminViewPaths();
    }

    public function ViewPaths() {
        $moduleLower = lcfirst('User');
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
            base_path("themes/$currentTheme/views/modules/User"),
            module_Viewpath('User', $currentTheme),
            base_path("themes/default/views/modules/User"),
            module_Viewpath('User', 'default'),
            base_path("resources/views/modules/User"),
        ];

        return $this->loadViewsFrom($views, $moduleLower);
    }

    public function adminViewPaths() {
        $moduleLower = lcfirst('User');
        $currentTheme = 'admin';
        $views = [
            module_Viewpath('User', $currentTheme),
            base_path("themes/$currentTheme/views/modules/User"),
        ];

        return $this->loadViewsFrom($views, $moduleLower . '-admin');
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
