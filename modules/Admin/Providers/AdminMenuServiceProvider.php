<?php

namespace Modules\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use Konekt\Menu\Facades\Menu;

class AdminMenuServiceProvider extends ServiceProvider {

    public function boot() {

        Menu::create('admin');
        // Add default menu items to sidebar
        if ($adminMenu = Menu::get('admin')) {

            $dashboard = $adminMenu->addItem('dashboard', __('Dashboard'), ['url' => ['/admin']])->data('order', 1);

            $cms = $adminMenu->addItem('cms_group', __('CMS'));
            // CRM Group
            $crm = $adminMenu->addItem('crm_group', __('CRM'));

            $crm
                    ->addSubItem('customers', __('Customers'), ['route' => ['appshell.customer.index']])
                    ->data('icon', 'customers')
                    ->activateOnUrls($this->routeWildcard('appshell.customer.index'))
                    ->allowIfUserCan('list customers');

            // Settings Group
            $settings = $adminMenu->addItem('settings_group', __('Settings'))->data('order', 10);
            $settings
                    ->addSubItem('settings', __('Settings'), ['route' => 'appshell.settings.index'])
                    ->data('icon', 'settings')
                    ->allowIfUserCan('list settings');
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
