<?php

namespace Modules\Bookable\Providers;

use Illuminate\Support\ServiceProvider;
use Konekt\Menu\Facades\Menu;

class AdminMenuServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot() {
        // Add default menu items to sidebar
        if ($adminMenu = Menu::get('admin')) {

            $bookable = $adminMenu->addItem('bookable', __('Bookables'))->data('order', 11);
            $bookable->addSubItem('services', __('Services'), '/admin/bookables')->activateOnUrls('admin/bookables/*');
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        //
    }

    private function routeWildcard(string $route): string {
        if (0 === strlen($path = parse_url(route($route), PHP_URL_PATH))) {
            return '';
        }

        if ('/' === $path[0]) {
            $path = substr($path, 1);
        }

        return "$path*";
    }

}
