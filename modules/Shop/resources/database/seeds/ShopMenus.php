<?php

namespace Modules\Shop\Resources\Database\Seeds;

use Illuminate\Database\Seeder;
use Modules\Core\Models\Menu;
use Modules\Core\Models\MenuItem;

class ShopMenus extends Seeder {

    public function run() {
        $mainMenu = Menu::where('name', 'Main Menu')->first();
        $userMenu = Menu::where('name', 'User Menu')->first();

        $shopMenuItem = MenuItem::create([
                    "name" => 'Shop',
                    "url" => 'product.index',
                    "menu_id" => $mainMenu->id,
                    'is_internal' => 1
        ]);

        $cartMenuItem = MenuItem::create([
                    "name" => 'Cart',
                    "url" => 'cart.show',
                    "menu_id" => $userMenu->id,
                    'is_internal' => 1
        ]);
    }

}
