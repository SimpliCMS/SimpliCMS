<?php

namespace Modules\Core\Providers;

use Konekt\Concord\BaseBoxServiceProvider;
use Konekt\AppShell\Providers\SettingsProvider;
use Illuminate\Support\Facades\DB;
use Schema;

class ModuleServiceProvider extends BaseBoxServiceProvider {

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot() {
        parent::boot();
        $this->app->register(CoreSettingsServiceProvider::class);
        $this->app->register(AdminMenuServiceProvider::class);
        $this->app->register(PluginServiceProvider::class);
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
            base_path("themes/$currentTheme/views/modules/Core"),
            module_Viewpath('Core', $currentTheme),
            base_path("themes/default/views/modules/Core"),
            module_Viewpath('Core', 'default'),
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
