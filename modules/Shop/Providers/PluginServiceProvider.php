<?php

namespace Modules\Shop\Providers;

use Illuminate\Support\ServiceProvider;
use Vanilo\Cart\Facades\Cart;
use TorMorten\Eventy\Facades\Events as Eventy;

class PluginServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot() {
        // Your boot logic here
        Eventy::addAction('menu.nameAfter', function ($item) {
            if ($item->name == 'Cart' && Cart::isNotEmpty()) {
                echo '<span class="badge badge-pill badge-secondary">' . Cart::itemCount() . '</span>';
            }
        }, 20, 1);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return [];
    }

}
