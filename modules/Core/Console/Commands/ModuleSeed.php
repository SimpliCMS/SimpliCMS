<?php

namespace Modules\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class ModuleSeed extends Command
{
    protected $signature = 'core:module:seed';

    protected $description = 'Run seeders for modules.';

    public function handle()
    {
        // Get all module directories
        $modulePath = 'modules';
        $moduleDirectories = File::directories($modulePath);

        // Loop through module directories
        foreach ($moduleDirectories as $moduleDirectory) {
            // Get module name from directory name
            $moduleName = File::basename($moduleDirectory);

            // Get seed path for current module
            $seedPath = "{$moduleDirectory}/resources/database/seeds";

            // Search for seeders in the seed path
            $seedFiles = File::glob("{$seedPath}/*.php");

            // Loop through seed files
            foreach ($seedFiles as $seedFile) {
                // Extract seeder class name from file name
                $seederClass = str_replace('.php', '', File::basename($seedFile));

                // Resolve the fully qualified class name
                $seederClass = "Modules\\{$moduleName}\\Resources\\Database\\Seeds\\{$seederClass}";

                // Call the run() method on the seeder
                $this->info("Seeding: {$seederClass}");
                Artisan::call('db:seed', ['--class' => $seederClass]);
            }
        }

        $this->info('Module seeders have been run successfully!');
    }
}
