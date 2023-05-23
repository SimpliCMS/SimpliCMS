<?php

namespace Modules\User\Resources\Database\Seeds;

use Illuminate\Database\Seeder;
use Modules\Core\Models\MenuProxy;
use Modules\Core\Models\MenuItemProxy;

class UserMenus extends Seeder {

    public function run() {
        $guestMenu = MenuProxy::where('name', 'Guest Menu')->first();

        $userMenu = MenuProxy::where('name', 'User Menu')->first();

        $loginMenuItem = MenuItemProxy::create([
                    "name" => 'Login',
                    "url" => 'login',
                    "menu_id" => $guestMenu->id,
                    'is_internal' => 1
        ]);

        $registerMenuItem = MenuItemProxy::create([
                    "name" => 'Register',
                    "url" => 'register',
                    "menu_id" => $guestMenu->id,
                    'is_internal' => 1
        ]);

        $adminMenuItem = MenuItemProxy::create([
                    "name" => 'Admin',
                    "url" => 'admin.index',
                    "permission" => 'access admin',
                    "menu_id" => $userMenu->id,
                    'is_internal' => 1
        ]);

        $accountMenuItem = MenuItemProxy::create([
                    "name" => 'Account Menu',
                    "url" => '#',
                    "menu_id" => $userMenu->id,
                    'is_internal' => 0
        ]);

        $accountsettingsMenuItem = MenuItemProxy::create([
                    "name" => 'Account Settings',
                    "url" => 'user.account',
                    "parent_id" => $accountMenuItem->id,
                    "menu_id" => $userMenu->id,
                    'order' => '1',
                    'is_internal' => 1
        ]);

        $logoutMenuItem = MenuItemProxy::create([
                    "name" => 'Logout',
                    "url" => 'logout',
                    "parent_id" => $accountMenuItem->id,
                    "menu_id" => $userMenu->id,
                    'order' => '3',
                    'is_internal' => 1
        ]);
    }

}
