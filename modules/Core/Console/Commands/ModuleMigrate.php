<?php

namespace Modules\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class ModuleMigrate extends Command {

    protected $signature = 'core:module:migrate {moduleName?} {--seed}';
    protected $description = 'Run database migrations for modules.';

    public function handle() {
        // Get the name of the module to migrate
        $moduleName = $this->argument('moduleName');

        // If a specific module is specified, run its migrations only
        if ($moduleName) {
            $this->migrateModule($moduleName);
        } else {
            // Otherwise, run all module migrations first
            $this->migrateAllModules();

            // Then, run Laravel core migrations
            $this->call('migrate');

            // Run seeders if --seed option is present
            if ($this->option('seed')) {
                if ($moduleName) {
                    $this->call('core:module:seed' . $moduleName);
                } else {
                    $this->call('db:seed');
                    $this->call('core:module:seed');
                }
            }
        }
    }

    protected function migrateAllModules() {
        $modulePath = 'modules';

        // Get all module directories
        $moduleDirectories = File::directories($modulePath);

        foreach ($moduleDirectories as $moduleDirectory) {
            $moduleName = File::basename($moduleDirectory);
            $this->migrateModule($moduleName);
        }
    }

    protected function migrateModule(string $moduleName) {
        $modulePath = "modules/{$moduleName}";

        $migrationPath = "{$modulePath}/resources/database/migrations";

        if ($this->laravel['files']->isDirectory($migrationPath)) {
            $this->info("Migrating module: {$moduleName}");
            Artisan::call('migrate', ['--path' => $migrationPath]);
        }
    }

}
