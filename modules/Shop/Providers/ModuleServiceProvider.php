<?php

namespace Modules\Shop\Providers;

use Konekt\Concord\BaseModuleServiceProvider;
use Illuminate\Support\Facades\DB;
use Vanilo\Cart\Facades\Cart;
use TorMorten\Eventy\Facades\Events as Eventy;
use Schema;

class ModuleServiceProvider extends BaseModuleServiceProvider {

    /**
     * The namespace for the module's models.
     *
     * @var string
     */
    protected $modelNamespace = 'Modules\Shop\Models';

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot() {
        $this->app->register(RouteServiceProvider::class);
        $this->app->concord->registerModule(\Vanilo\Foundation\Providers\ModuleServiceProvider::class,
                $config = [
            'image' => [
                'taxon' => [
                    'variants' => [
                        'thumbnail' => [
                            'width' => 250,
                            'height' => 188,
                            'fit' => 'contain'
                        ],
                        'header' => [
                            'width' => 1110,
                            'height' => 150,
                            'fit' => 'contain'
                        ],
                        'card' => [
                            'width' => 521,
                            'height' => 293,
                            'fit' => 'contain'
                        ]
                    ]
                ],
                'variants' => [
                    'thumbnail' => [
                        'width' => 250,
                        'height' => 188,
                        'fit' => 'fill'
                    ],
                    'medium' => [
                        'width' => 540,
                        'height' => 406,
                        'fit' => 'fill'
                    ]
                ]
            ],
                ]
        );

        $this->app->concord->registerModule(\Vanilo\Admin\Providers\ModuleServiceProvider::class);
        $this->app->concord->registerModule(\Vanilo\Adyen\Providers\ModuleServiceProvider::class);
        $this->app->concord->registerModule(\Vanilo\Braintree\Providers\ModuleServiceProvider::class);
        $this->app->concord->registerModule(\Vanilo\Euplatesc\Providers\ModuleServiceProvider::class);
        $this->app->concord->registerModule(\Vanilo\Netopia\Providers\ModuleServiceProvider::class);
        $this->app->concord->registerModule(\Vanilo\Paypal\Providers\ModuleServiceProvider::class);
        $this->app->concord->registerModule(\Vanilo\Simplepay\Providers\ModuleServiceProvider::class);
        $this->app->concord->registerModule(\Vanilo\Stripe\Providers\ModuleServiceProvider::class);
        $this->app->register(AdminMenuServiceProvider::class);
        $this->app->register(PluginServiceProvider::class);
        $this->ViewPaths();
        $this->adminViewPaths();
    }

    public function ViewPaths() {
        $moduleLower = lcfirst('Shop');
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
            base_path("themes/$currentTheme/views/modules/Shop"),
            module_Viewpath('Shop', $currentTheme),
            base_path("themes/default/views/modules/Shop"),
            module_Viewpath('Shop', 'default'),
            base_path("resources/views/modules/Shop"),
        ];

        return $this->loadViewsFrom($views, $moduleLower);
    }

    public function adminViewPaths() {
        $moduleLower = lcfirst('Shop');
        $currentTheme = 'admin';
        $views = [
            module_Viewpath('Shop', $currentTheme),
            base_path("themes/$currentTheme/views/modules/Shop"),
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
