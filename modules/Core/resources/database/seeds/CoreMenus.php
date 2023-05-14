<?php

namespace Modules\Core\Resources\Database\Seeds;

use Illuminate\Database\Seeder;
use Modules\Core\Models\Menu;
use Modules\Core\Models\MenuItem;

class CoreMenus extends Seeder {

    public function run() {
        $mainMenu = Menu::create([
                    'name' => 'Main Menu',
                    'slug' => 'main-menu',
        ]);

        $guestMenu = Menu::create([
                    'name' => 'Guest Menu',
                    'slug' => 'guest-menu',
        ]);

        $userMenu = Menu::create([
                    'name' => 'User Menu',
                    'slug' => 'user-menu',
        ]);

        $footerMenu = Menu::create([
                    'name' => 'Footer Menu',
                    'slug' => 'footer-menu',
        ]);

        $homeMenuItem = MenuItem::create([
                    "name" => 'Home',
                    "url" => 'home',
                    "menu_id" => $mainMenu->id,
                    'is_internal' => 1
        ]);
        
        $privacyMenuItem = MenuItem::create([
                    "name" => 'Privacy',
                    "url" => '/page/privacy',
                    "menu_id" => $footerMenu->id,
                    'is_internal' => 0
        ]);
        
         $termsMenuItem = MenuItem::create([
                    "name" => 'Terms',
                    "url" => '/page/terms',
                    "menu_id" => $footerMenu->id,
                    'is_internal' => 0
        ]);
    }

}
