<?php

namespace Modules\Core\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        \Modules\Core\Console\Commands\MakeModuleCommand::class,
        \Modules\Core\Console\Commands\ModuleMigrate::class,
        \Modules\Core\Console\Commands\ModuleSeed::class,
         \Modules\Core\Console\Commands\MakeModuleMigration::class,
        \Modules\Core\Console\Commands\MakeModuleSeed::class,
        \Modules\Core\Console\Commands\MakeModuleController::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands() {
        $this->load(__DIR__ . '/Commands');

        require base_path('modules/Core/resources/routes/console.php');
    }

}
