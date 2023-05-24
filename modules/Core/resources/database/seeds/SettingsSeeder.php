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
        $reg->addByKey('site.mail_driver');
        $reg->addByKey('site.mail_host');
        $reg->addByKey('site.mail_port');
        $reg->addByKey('site.mail_encryption');
        $reg->addByKey('site.mail_username');
        $reg->addByKey('site.mail_password');

        Settings::set('site.description', 'Enter your SEO site description here');
        Settings::set('site.keywords', 'Enter your SEO site keywords here');
        Settings::set('site.theme', 'default');

        Settings::set('site.mail_driver', 'smtp');
        Settings::set('site.mail_host', 'smtp.mailgun.org');
        Settings::set('site.mail_port', 587);
        Settings::set('site.mail_encryption', 'tls');
        Settings::set('site.mail_username', '');
        Settings::set('site.mail_password', '');
        Settings::set('site.mail_from_email', 'hello@example.com');
        Settings::set('site.mail_from_name', 'Example');
    }

}
