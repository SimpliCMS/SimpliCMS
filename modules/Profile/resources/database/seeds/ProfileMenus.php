<?php

namespace Modules\Profile\Resources\Database\Seeds;

use Illuminate\Database\Seeder;
use Modules\Core\Models\MenuProxy;
use Modules\Core\Models\MenuItemProxy;

class ProfileMenus extends Seeder {

    public function run() {
        $userMenu = MenuProxy::where('name', 'User Menu')->first();
        $accountMenuItem = MenuItemProxy::where('name', 'Account Menu')->first();

        $accountsettingsMenuItem = MenuItemProxy::create([
                    "name" => 'Profile Settings',
                    "url" => 'profile.settings',
                    "parent_id" => $accountMenuItem->id,
                    "menu_id" => $userMenu->id,
                    'order' => '2',
                    'is_internal' => 1
        ]);
    }

}
