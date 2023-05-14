<?php

namespace Modules\Profile\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class ProfileSettingsServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot() {
        // Your boot logic here
        // Define a new disk configuration
        Config::set('filesystems.disks.profile_avatar', [
            'driver' => 'local',
            'root' => storage_path('app/profile/avatars'),
            'url' => env('APP_URL').'app/storage/app/profile/avatars',
            'visibility' => 'public',
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return [];
    }

}
