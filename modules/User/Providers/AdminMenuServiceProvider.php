<?php

namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;
use Konekt\Menu\Facades\Menu;

class AdminMenuServiceProvider extends ServiceProvider {

    public function boot() {
        $this->app->booted(function () {
            // Add default menu items to sidebar
            if ($adminMenu = Menu::get('admin')) {
                $users = $adminMenu->addItem('users_group', __('Users'));

                $users
                        ->addSubItem('users', __('Users'), ['route' => 'appshell.user.index'])
                        ->data('icon', 'users')
                        ->activateOnUrls($this->routeWildcard('appshell.user.index'))
                        ->allowIfUserCan('list users');
                $users
                        ->addSubItem('roles', __('Permissions'), ['route' => 'appshell.role.index'])
                        ->data('icon', 'security')
                        ->activateOnUrls($this->routeWildcard('appshell.role.index'))
                        ->allowIfUserCan('list roles');
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
