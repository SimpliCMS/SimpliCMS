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
    
}
