<?php

namespace Modules\Profile\Resources\Database\Seeds;

use Illuminate\Database\Seeder;
use Modules\Core\Models\Menu;
use Modules\Core\Models\MenuItem;

class ProfileMenus extends Seeder {

    public function run() {
        $userMenu = Menu::where('name', 'User Menu')->first();
        $accountMenuItem = MenuItem::where('name', 'Account Menu')->first();

        $accountsettingsMenuItem = MenuItem::create([
                    "name" => 'Profile Settings',
                    "url" => 'profile.settings',
                    "parent_id" => $accountMenuItem->id,
                    "menu_id" => $userMenu->id,
                    'order' => '2',
                    'is_internal' => 1
        ]);
    }

}
