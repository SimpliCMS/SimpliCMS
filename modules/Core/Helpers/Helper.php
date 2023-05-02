<?php

namespace Modules\Core\Helpers;

use Modules\Core\Models\Menu;
use Modules\Core\Models\MenuItem;

class Helper {

    public static function module_path($module) {
        $location = base_path();
        $modulesPath = $location . '/' . 'modules';

        return $modulesPath . '/' . $module;
    }

    public static function module_Viewpath($module, $theme) {
        $location = base_path();
        $modulesPath = $location . '/' . 'modules';

        return $modulesPath . '/' . $module . '/resources/views/themes/' . $theme;
    }

    public static function getMenu($menuName) {

        $menu = Menu::with('items.children')->where('name', $menuName)->first();
        $menuItems = MenuItem::where('menu_id', $menu->id)->orderBy('order', 'DESC')->get();
        return $menuItems;
    }

}
