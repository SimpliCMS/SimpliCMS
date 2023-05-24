<?php

namespace Modules\Core\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Konekt\Gears\Defaults\SimpleSetting;
use Konekt\Gears\Facades\Settings;
use Konekt\AppShell\Settings\UiNameSetting;
use Schema;
use Menu;

class CoreSettingsServiceProvider extends ServiceProvider {

    public function boot() {
        if (Schema::hasTable('settings')) {
            Config::set('app.name', Settings::get('appshell.ui.name'));
            $settingsRegistry = $this->app['gears.settings_registry'];

            $settingsRegistry->addByKey('site.description');
            $settingsRegistry->addByKey('site.keywords');
            $settingsRegistry->addByKey('site.mail_driver');
            $settingsRegistry->addByKey('site.mail_host');
            $settingsRegistry->addByKey('site.mail_port');
            $settingsRegistry->addByKey('site.mail_encryption');
            $settingsRegistry->addByKey('site.mail_username');
            $settingsRegistry->addByKey('site.mail_password');

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
            $settingsRegistry->add(new SimpleSetting('site.mail_driver', 'smtp', array("smtp", "sendmail", "mailgun", "mandrill", "ses", "sparkpost")));
            $settingsRegistry->add(new SimpleSetting('site.mail_host', 'smtp.mailgun.org'));
            $settingsRegistry->add(new SimpleSetting('site.mail_port', 587));
            $settingsRegistry->add(new SimpleSetting('site.mail_encryption', 'tls'));
            $settingsRegistry->add(new SimpleSetting('site.mail_username'));
            $settingsRegistry->add(new SimpleSetting('site.mail_password'));
            $settingsRegistry->add(new SimpleSetting('site.mail_from_name', 'Example'));
            $settingsRegistry->add(new SimpleSetting('site.mail_from_email', 'hello@example.com'));

            $settingsTreeBuilder = $this->app['appshell.settings_tree_builder'];
            $settingsTreeBuilder
                    ->addSettingItem(
                            'general_app',
                            ['text', ['label' => __('Name')]],
                            UiNameSetting::KEY
                    )
                    ->addSettingItem('general_app', ['select-name', ['label' => __('Site Theme')]], 'site.theme')
                    ->addSettingItem('general_app', ['textarea', ['label' => __('Site Description')]], 'site.description')
                    ->addSettingItem('general_app', ['textarea', ['label' => __('Site Keywords')]], 'site.keywords')
                    ->addSettingItem('defaults', ['select', ['label' => __('Default Country')]], 'appshell.default.country')
                    ->addSettingItem('defaults', ['select', ['label' => __('Default Currency')]], 'appshell.default.currency');

            $settingsTreeBuilder->addRootNode('performance', __('Performance Settings'))
                    ->addChildNode('performance', 'performance_app', __('Website Performance'));

            $settingsTreeBuilder->addRootNode('mail', __('Mail Settings'))
                    ->addChildNode('mail', 'mail_app', __('Website Mail Settings'))
                     ->addChildNode('mail', 'mail_app_more', __('Additional Mail Settings'))
                    ->addSettingItem('mail_app', ['select-name', ['label' => __('Mail Driver')]], 'site.mail_driver')
                    ->addSettingItem('mail_app', ['text', ['label' => __('Mail Host')]], 'site.mail_host')
                    ->addSettingItem('mail_app', ['text', ['label' => __('Mail Port')]], 'site.mail_port')
                    ->addSettingItem('mail_app', ['text', ['label' => __('Mail Encryption')]], 'site.mail_encryption')
                    ->addSettingItem('mail_app', ['text', ['label' => __('Mail Username')]], 'site.mail_username')
                    ->addSettingItem('mail_app', ['text', ['label' => __('Mail Password')]], 'site.mail_password')
                    ->addSettingItem('mail_app', ['text', ['label' => __('Mail From Name')]], 'site.mail_from_name')
                    ->addSettingItem('mail_app', ['text', ['label' => __('Mail From Email')]], 'site.mail_from_email');

            Config::set('mail', [
                'driver' => Settings::get('site.mail_driver'),
                'host' => Settings::get('site.mail_host'),
                'port' => Settings::get('site.mail_port'),
                'from' => [
                    'address' => Settings::get('site.mail_from_email'),
                    'name' => Settings::get('site.mail_from_name'),
                ],
                'encryption' => Settings::get('site.mail_encryption'),
                'username' => Settings::get('site.mail_username'),
                'password' => Settings::get('site.mail_password'),
            ]);
        }
    }

}
