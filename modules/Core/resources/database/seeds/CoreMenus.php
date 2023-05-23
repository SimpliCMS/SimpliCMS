<?php

namespace Modules\Core\Resources\Database\Seeds;

use Illuminate\Database\Seeder;
use Modules\Core\Models\MenuProxy;
use Modules\Core\Models\MenuItemProxy;

class CoreMenus extends Seeder {

    public function run() {
        $mainMenu = MenuProxy::create([
                    'name' => 'Main Menu',
                    'slug' => 'main-menu',
        ]);

        $guestMenu = MenuProxy::create([
                    'name' => 'Guest Menu',
                    'slug' => 'guest-menu',
        ]);

        $userMenu = MenuProxy::create([
                    'name' => 'User Menu',
                    'slug' => 'user-menu',
        ]);

        $footerMenu = MenuProxy::create([
                    'name' => 'Footer Menu',
                    'slug' => 'footer-menu',
        ]);

        $homeMenuItem = MenuItemProxy::create([
                    "name" => 'Home',
                    "url" => 'home',
                    "menu_id" => $mainMenu->id,
                    'is_internal' => 1
        ]);
        
        $privacyMenuItem = MenuItemProxy::create([
                    "name" => 'Privacy',
                    "url" => '/page/privacy',
                    "menu_id" => $footerMenu->id,
                    'is_internal' => 0
        ]);
        
         $termsMenuItem = MenuItemProxy::create([
                    "name" => 'Terms',
                    "url" => '/page/terms',
                    "menu_id" => $footerMenu->id,
                    'is_internal' => 0
        ]);
    }

}
