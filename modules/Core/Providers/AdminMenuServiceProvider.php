<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Konekt\Menu\Facades\Menu;

class AdminMenuServiceProvider extends ServiceProvider {

    public function boot() {
        $this->app->booted(function () {
            // Add default menu items to sidebar
            if ($adminMenu = Menu::get('admin')) {

                $cms = $adminMenu->getItem('cms_group');
                $cms
                        ->addSubItem('menus', __('Menus'),  ['route' => 'menus.index'])
                        ->activateOnUrls($this->routeWildcard('menus.index'));
                $cms
                        ->addSubItem('pages', __('Pages'),  ['route' => 'pages.admin.index'])
                        ->activateOnUrls($this->routeWildcard('pages.admin.index'));
            }
        });
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
