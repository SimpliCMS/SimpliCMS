<?php

namespace Modules\Core\Http\Controllers\Admin;

use Modules\Core\Models\Menu;
use Modules\Core\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Core\Http\Controllers\Controller;

class MenuController extends Controller {

    public function index() {
        $menus = Menu::all();

        return view('core-admin::menus.index', compact('menus'));
    }

    public function create() {
        return view('core-admin::menus.create');
    }

    public function store(Request $request) {
        $menu = Menu::create($request->only(['name', 'slug']));

        return redirect()->route('menus.index');
    }

    public function show(Menu $menu) {
        $menu->load('menuItems');

        return view('core-admin::menus.show', compact('menu'));
    }

    public function edit(Menu $menu) {
        return view('core-admin::menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu) {
        $menu->update($request->only(['name', 'slug']));

        return redirect()->route('menus.index');
    }

    public function destroy(Menu $menu) {
        $menu->delete();

        return redirect()->route('menus.index');
    }

}
