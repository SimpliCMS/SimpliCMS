<?php

namespace Modules\User\Resources\Database\Seeds;

use Illuminate\Database\Seeder;
use Modules\Core\Models\Menu;
use Modules\Core\Models\MenuItem;

class UserMenus extends Seeder {

    public function run() {
        $guestMenu = Menu::where('name', 'Guest Menu')->first();

        $userMenu = Menu::where('name', 'User Menu')->first();

        $loginMenuItem = MenuItem::create([
                    "name" => 'Login',
                    "url" => 'login',
                    "menu_id" => $guestMenu->id,
                    'is_internal' => 1
        ]);

        $registerMenuItem = MenuItem::create([
                    "name" => 'Register',
                    "url" => 'register',
                    "menu_id" => $guestMenu->id,
                    'is_internal' => 1
        ]);

        $adminMenuItem = MenuItem::create([
                    "name" => 'Admin',
                    "url" => 'admin.index',
                    "permission" => 'access admin',
                    "menu_id" => $userMenu->id,
                    'is_internal' => 1
        ]);

        $accountMenuItem = MenuItem::create([
                    "name" => 'Account Menu',
                    "url" => '#',
                    "menu_id" => $userMenu->id,
                    'is_internal' => 0
        ]);

        $accountsettingsMenuItem = MenuItem::create([
                    "name" => 'Account Settings',
                    "url" => 'user.account',
                    "parent_id" => $accountMenuItem->id,
                    "menu_id" => $userMenu->id,
                    'is_internal' => 1
        ]);

        $logoutMenuItem = MenuItem::create([
                    "name" => 'Logout',
                    "url" => 'logout',
                    "parent_id" => $accountMenuItem->id,
                    "menu_id" => $userMenu->id,
                    'is_internal' => 1
        ]);
    }

}
