<?php

namespace Modules\Core\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Konekt\Gears\Defaults\SimpleSetting;
use Schema;
use Menu;

class CoreSettingsServiceProvider extends ServiceProvider {

    public function boot() {
        if (Schema::hasTable('settings')) {
            $settingsRegistry = $this->app['gears.settings_registry'];

            $settingsRegistry->addByKey('site.description');
            $settingsRegistry->addByKey('site.keywords');
           
            $themesDirectory = base_path('themes');
            $themes = [];
            foreach (new \DirectoryIterator($themesDirectory) as $fileInfo) {
                if ($fileInfo->isDot() || !$fileInfo->isDir()) {
                    continue;
                }
                $themeName = $fileInfo->getFilename();
                if ($themeName === 'admin') {
                    continue;
                }
                $themes[] = $themeName;
            }
            $settingsRegistry->add(new SimpleSetting('site.theme', 'default', $themes));

            $settingsTreeBuilder = $this->app['appshell.settings_tree_builder'];
            $settingsTreeBuilder
                    ->addSettingItem('general_app', ['select-name', ['label' => __('Site Theme')]], 'site.theme')
                    ->addSettingItem('general_app', ['textarea', ['label' => __('Site Description')]], 'site.description')
                    ->addSettingItem('general_app', ['textarea', ['label' => __('Site Keywords')]], 'site.keywords');

            if ($menu = Menu::get('appshell')) {
                // Add a new group
                $newGroup = $menu->addItem('cms', __('CMS'));
                $newGroup
                        ->addSubItem('menus', __('Menus'), '/admin/menus')->activateOnUrls('admin/menus/*');
            }
        }
    }

}
