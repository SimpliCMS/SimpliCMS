<?php

namespace Modules\Shop\Providers;

use Illuminate\Support\ServiceProvider;
use Konekt\Menu\Facades\Menu;

class AdminMenuServiceProvider extends ServiceProvider {

    public function boot() {

        // Add default menu items to sidebar
        if ($adminMenu = Menu::get('admin')) {
            $shop = $adminMenu->addItem('shop', __('Shop'))->data('order', 11);
            $shop->addSubItem('products', __('Products'), ['route' => 'vanilo.admin.product.index'])
                    ->data('icon', 'product')
                    ->activateOnUrls(route('vanilo.admin.product.index', [], false) . '*')
                    ->allowIfUserCan('list products');
            $shop->addSubItem('product_properties', __('Product Properties'), ['route' => 'vanilo.admin.property.index'])
                    ->data('icon', 'properties')
                    ->activateOnUrls(route('vanilo.admin.property.index', [], false) . '*')
                    ->allowIfUserCan('list properties');
            $shop->addSubItem('categories', __('Categorization'), ['route' => 'vanilo.admin.taxonomy.index'])
                    ->data('icon', 'taxonomies')
                    ->activateOnUrls(route('vanilo.admin.taxonomy.index', [], false) . '*')
                    ->allowIfUserCan('list taxonomies');
            $shop->addSubItem('orders', __('Orders'), ['route' => 'vanilo.admin.order.index'])
                    ->data('icon', 'bag')
                    ->activateOnUrls(route('vanilo.admin.order.index', [], false) . '*')
                    ->allowIfUserCan('list orders');

            $settings = $adminMenu->getItem('settings_group');
            $settings->addSubItem('channels', __('Channels'), ['route' => 'vanilo.admin.channel.index'])
                    ->data('icon', 'channel')
                    ->activateOnUrls(route('vanilo.admin.channel.index', [], false) . '*')
                    ->allowIfUserCan('list channels');
            $settings->addSubItem('zones', __('Zones'), ['route' => 'vanilo.admin.zone.index'])
                    ->data('icon', 'zone')
                    ->activateOnUrls(route('vanilo.admin.zone.index', [], false) . '*')
                    ->allowIfUserCan('list zones');
            $settings->addSubItem('payment-methods', __('Payment Methods'), ['route' => 'vanilo.admin.payment-method.index'])
                    ->data('icon', 'payment-method')
                    ->activateOnUrls(route('vanilo.admin.payment-method.index', [], false) . '*')
                    ->allowIfUserCan('list payment methods');
            $settings->addSubItem('shipping-methods', __('Shipping Methods'), ['route' => 'vanilo.admin.shipping-method.index'])
                    ->data('icon', 'shipping')
                    ->activateOnUrls(route('vanilo.admin.shipping-method.index', [], false) . '*')
                    ->allowIfUserCan('list shipping methods');
            $settings->addSubItem('carriers', __('Carriers'), ['route' => 'vanilo.admin.carrier.index'])
                    ->data('icon', 'carrier')
                    ->activateOnUrls(route('vanilo.admin.carrier.index', [], false) . '*')
                    ->allowIfUserCan('list carriers');
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
