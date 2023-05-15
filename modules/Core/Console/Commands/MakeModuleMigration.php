<?php

namespace Modules\Core\Console\Commands;

use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Support\Composer;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModuleMigration extends Command {

    protected $signature = 'core:module:make:migration {moduleName : The name of the module} {migrationName : The name of the migration}';
    protected $description = 'Create a new migration file for a module';

    public function handle() {
        $moduleName = $this->argument('moduleName');
        $migrationName = $this->argument('migrationName');

        // Check if the module directory exists
        if (!File::isDirectory(base_path("modules/{$moduleName}"))) {
            $this->error("Module {$moduleName} does not exist.");
            return;
        }

        // Create the migrations directory if it doesn't exist
        $migrationsPath = base_path("modules/{$moduleName}/resources/database/migrations");
        if (!File::isDirectory($migrationsPath)) {
            File::makeDirectory($migrationsPath, 0755, true);
        }

        // Generate the migration file name
        $fileName = date('Y_m_d_His') . '_' . $migrationName . '.php';

        // Generate the migration file content using a stub
        $stubPath = base_path('/modules/Core/Console/Commands/stubs/migration.stub');
        $stubContent = File::get($stubPath);
        $string = $stubContent;
        $studlystring = $migrationName;
        $studlyCase = Str::studly($studlystring);
        $search = array('{{migrationName}}', '{{migrationNameStudly}}');
        $replace = array($migrationName, $studlyCase);
        $stubContent = str_replace($search, $replace, $string);

        // Save the migration file
        $filePath = $migrationsPath . '/' . $fileName;
        File::put($filePath, $stubContent);

        $this->info("Migration created successfully: {$fileName}");
    }

}
