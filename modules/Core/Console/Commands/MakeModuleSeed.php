<?php

namespace Modules\Core\Console\Commands;

use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Support\Composer;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModuleSeed extends Command {

    protected $signature = 'core:module:make:seed {moduleName : The name of the module} {seedName : The name of the migration}';
    protected $description = 'Create a new seed file for a module';

    public function handle() {
        $moduleName = $this->argument('moduleName');
        $seedName = $this->argument('seedName');

        // Check if the module directory exists
        if (!File::isDirectory(base_path("modules/{$moduleName}"))) {
            $this->error("Module {$moduleName} does not exist.");
            return;
        }

        // Create the migrations directory if it doesn't exist
        $seedsPath = base_path("modules/{$moduleName}/resources/database/seeds");
        if (!File::isDirectory($seedsPath)) {
            File::makeDirectory($seedsPath, 0755, true);
        }

        // Generate the migration file name
        $fileName = $seedName . '.php';

        // Generate the migration file content using a stub
        $stubPath = base_path('/modules/Core/Console/Commands/stubs/seed.stub');
        $stubContent = File::get($stubPath);

        $string = $stubContent;
        $search = array('{{moduleName}}', '{{seedName}}');
        $replace = array($moduleName, $seedName);
        $stubContent = str_replace($search, $replace, $string);

        // Save the migration file
        $filePath = $seedsPath . '/' . $fileName;
        File::put($filePath, $stubContent);

        $output = null;
        system('composer dump-autoload', $output);

        $this->info("Seed created successfully: {$fileName}");
    }

}
