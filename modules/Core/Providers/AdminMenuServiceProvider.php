<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Konekt\Menu\Facades\Menu;

class AdminMenuServiceProvider extends ServiceProvider {

    public function boot() {

        // Add default menu items to sidebar
        if ($adminMenu = Menu::get('admin')) {

            $cms = $adminMenu->getItem('cms_group');
            $cms
              ->addSubItem('menus', __('Menus'), '/admin/menus')->activateOnUrls('admin/menus/*');
        }
    }

    public function register() {
        
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
