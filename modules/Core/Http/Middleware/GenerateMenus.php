<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Konekt\Gears\Facades\Settings;
use Illuminate\Support\Facades\DB;
use Konekt\Menu\Facades\Menu as MenuBuilder;
use Modules\Core\Models\Menu;
use Modules\Core\Models\MenuItem;
use Schema;

class GenerateMenus {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        $menus = Menu::all();
        foreach ($menus as $menu) {
            $menuBuilder = MenuBuilder::create($menu->name);

            foreach ($menu->items as $item) {
                if ($item->parent_id === null) {
                    if ($item->children->count() > 0) {
                        if ($item->is_internal == 1) {
                            $menuBuilder->addItem(lcfirst($item->name), $item->name, ['url' => route($item->url)]);
                        } else {
                            $menuBuilder->addItem(lcfirst($item->name), $item->name, ['url' => $item->url]);
                        }
                    } else {
                        if ($item->is_internal == 1) {
                            $menuBuilder->addItem(lcfirst($item->name), $item->name, ['url' => route($item->url)])->link->attr('class', 'nav-link');
                        } else {
                            $menuBuilder->addItem(lcfirst($item->name), $item->name, ['url' => $item->url]);
                        }
                    }

                    foreach ($item->children as $childItem) {
                        if ($childItem->is_internal == 1) {
                            $menuBuilder->getItem(lcfirst($item->name))->addSubItem(lcfirst($childItem->name), $childItem->name, ['url' => route($childItem->url)]);
                        } else {
                            $menuBuilder->getItem(lcfirst($item->name))->addSubItem(lcfirst($childItem->name), $childItem->name, ['url' => $childItem->url]);
                        }
                    }
                }
            }
        }
        return $next($request);
    }

}
