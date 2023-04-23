<?php

namespace Modules\Core\Resources\Database\Seeds;

use Illuminate\Database\Seeder;
use Konekt\Gears\Facades\Settings;
use Konekt\Gears\Defaults\SimpleSetting;

class SettingsSeeder extends Seeder {

    public function run() {
        $reg = app('gears.settings_registry');
        $reg->addByKey('site.description');
        $reg->addByKey('site.keywords');
        $reg->addByKey('site.theme');
        
        Settings::set('appshell.ui.name', 'SimpliCMS');
        Settings::set('site.description', 'Enter your SEO site description here');
        Settings::set('site.keywords', 'Enter your SEO site keywords here');
        Settings::set('site.theme', 'default');
    }

}
