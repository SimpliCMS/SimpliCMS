<?php

namespace Modules\Bookable\Providers;

use Konekt\Concord\BaseModuleServiceProvider;
use Illuminate\Support\Facades\DB;
use Modules\Bookable\Models\Bookable;
use Modules\Bookable\Models\BookableState;
use Modules\Bookable\Http\Requests\CreateBookable;
use Modules\Bookable\Http\Requests\UpdateBookable;
use Schema;

class ModuleServiceProvider extends BaseModuleServiceProvider {

    /**
     * The namespace for the module's models.
     *
     * @var string
     */
    protected $modelNamespace = 'Modules\Bookable\Models';
    protected $models = [
        Bookable::class,
    ];
    protected $enums = [
        BookableState::class,
    ];
    protected $requests = [
        CreateBookable::class,
        UpdateBookable::class,
    ];

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot() {
        parent::boot();
        // Your module's boot logic here
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(AdminMenuServiceProvider::class);
        $this->app->register(PluginServiceProvider::class);
        $this->ViewPaths();
        $this->adminViewPaths();
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register() {
        // Your module's register logic here
    }

    public function ViewPaths() {
        $moduleLower = lcfirst('Bookable');
        if (Schema::hasTable('settings')) {
            $setting = DB::table('settings')->where('id', 'site.theme')->first();
            $currentTheme = $setting->value;
        } else {
            $currentTheme = 'default';
        }
        $views = [
            base_path("themes/$currentTheme/views/modules/Bookable"),
            module_Viewpath('Bookable', $currentTheme),
            base_path("themes/default/views/modules/Bookable"),
            module_Viewpath('Bookable', 'default'),
            base_path("resources/views/modules/Bookable"),
        ];

        return $this->loadViewsFrom($views, $moduleLower);
    }

    public function adminViewPaths() {
        $moduleLower = lcfirst('Bookable');
        $currentTheme = 'admin';
        $views = [
            module_Viewpath('Bookable', $currentTheme),
            base_path("themes/$currentTheme/views/modules/Bookable"),
        ];

        return $this->loadViewsFrom($views, $moduleLower . '-admin');
    }

}
