<?php

namespace Modules\Admin\Resources\Database\Seeds;

use Illuminate\Database\Seeder;
use Konekt\Gears\Facades\Settings;
use Konekt\Gears\Defaults\SimpleSetting;

class AdminSettings extends Seeder {

    public function run() {

        Settings::set('appshell.ui.name', 'SimpliCMS');
        Settings::set('appshell.ui.icon_theme', 'font-awesome6');
    }

}
