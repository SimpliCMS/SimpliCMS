<?php

namespace Modules\Core\Http\Controllers;

use Modules\Core\Models\Menu;
use Modules\Core\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacde;
use Illuminate\Support\Facades\Route;

class MenuItemController extends Controller {

    public function create(Menu $menu) {
        $menuAll = Menu::all(); // Get all menus
        $menuItems = MenuItem::all();
        return view('core-admin::menu_items.create', compact('menu', 'menuAll', 'menuItems'));
    }

    public function store(RequestFacde $request) {
        $name = RequestFacde::input('name');
        $url = RequestFacde::input('url');
        $is_internal = RequestFacde::input('is_internal');
        $menu_id = RequestFacde::input('menu_id');
        $parent_id = RequestFacde::input('parent_id');
        MenuItem::create([
            "name" => $name,
            "url" => $url,
            "menu_id" => $menu_id,
            "parent_id" => $parent_id
        ]);

        return redirect(route('menus.show', $menu_id));
    }

    public function edit($menu, $menuItem) {
        $menu = Menu::find($menu);
        $menuSubItem = MenuItem::find($menuItem);
        $menus = Menu::all();
        $menuItems = MenuItem::all();
        return view('core-admin::menu_items.edit', compact('menu', 'menuSubItem', 'menus', 'menuItems'));
    }

    public function update(Request $request, Menu $menu, MenuItem $menuItem) {
        // Retrieve the submitted form data
        $data = $request->all();

        // Update the menu item with the form data
        $menuItem->update($data);

        // Redirect to the edit page with a success message
        return redirect()->route('menus.menu_items.edit', ['menu' => $menu->id, 'menuItem' => $menuItem->id])
                        ->with('success', 'Menu item updated successfully');
    }

    public function destroy(MenuItem $menuItem, $redirectid) {
        $menu = $menuItem->menu;
        $menuItem->delete();

        return redirect()->route('menus.show', $redirectid);
    }

}