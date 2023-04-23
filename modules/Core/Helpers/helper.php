<?php

function module_path($module) {
    $location = base_path();
    $modulesPath = $location . '/' . 'modules';

    return $modulesPath . '/' . $module;
}

function module_Viewpath($module, $theme) {
    $location = base_path();
    $modulesPath = $location . '/' . 'modules';

    return $modulesPath . '/' . $module . '/resources/views/themes/' . $theme;
}

function showMenu($menuName, $alignment = 'left') {

    $menu = \Modules\Core\Models\Menu::with('items.children')->where('name', $menuName)->first();
    if (auth()->check()) {
        $user = auth()->user();
        $user->hasRole('admin');
    }

    if (!$menu) {
        return '';
    }

    $html = $alignment === 'left' ? '<ul class="navbar-nav mr-auto">' : '<ul class="navbar-nav ml-auto">';

    foreach ($menu->items as $item) {
        if ($item->parent_id === null) {
            $html .= '<li class="nav-item dropdown">'; // Add the 'dropdown' class for dropdown functionality
            if ($item->children->count() > 0) {
                if ($item->is_internal == 1) {
                    $html .= '<a class="nav-link dropdown-toggle" href="' . route($item->url) . '" id="' . $item->name . '" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $item->name . '</a>'; // Add the 'dropdown-toggle' class and necessary data attributes for dropdown functionality
                } else {
                    $html .= '<a class="nav-link dropdown-toggle" href="' . $item->url . '" id="' . $item->name . '" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $item->name . '</a>'; // Add the 'dropdown-toggle' class and necessary data attributes for dropdown functionality
                }
            } else {
                if ($item->is_internal == 1) {
                    $html .= '<a class="nav-link" href="' . route($item->url) . '">' . $item->name . '</a>';
                } else {
                    $html .= '<a class="nav-link" href="' . $item->url . '">' . $item->name . '</a>';
                }
            }
            if ($item->children->count() > 0) {
                $html .= '<ul class="dropdown-menu" aria-labelledby="' . $item->name . '">'; // Add the 'dropdown-menu' class and necessary 'aria-labelledby' attribute

                foreach ($item->children as $childItem) {
                    if ($childItem->is_internal == 1) {
                        $html .= '<li><a class="dropdown-item" href="' . route($childItem->url) . '">' . $childItem->name . '</a></li>';
                    } else {
                        $html .= '<li><a class="dropdown-item" href="' . $childItem->url . '">' . $childItem->name . '</a></li>';
                    }
                }

                $html .= '</ul>';
            }

            $html .= '</li>';
        }
    }

    $html .= '</ul>';

    return $html;
}
