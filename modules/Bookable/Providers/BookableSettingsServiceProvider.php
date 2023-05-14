<?php

namespace Modules\Bookable\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class BookableSettingsServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot() {
        // Your boot logic here
        Config::set('filesystems.disks.bookable', [
            'driver' => 'local',
            'root' => storage_path('app/bookable'),
            'url' => env('APP_URL') . 'app/storage/app/bookable',
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
