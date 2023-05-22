<?php

namespace Modules\Core\Console\Commands;

use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Support\Composer;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModuleModel extends Command {

    protected $signature = 'core:module:make:model {moduleName : The name of the module} {modelName : The name of the model}';
    protected $description = 'Create a new model for a module';

    public function handle() {
        $moduleName = $this->argument('moduleName');
        $modelName = $this->argument('modelName');

        // Check if the module directory exists
        if (!File::isDirectory(base_path("modules/{$moduleName}"))) {
            $this->error("Module {$moduleName} does not exist.");
            return;
        }

        // Create the controllers directory if it doesn't exist
        $modelPath = base_path("modules/{$moduleName}/Models");
        if (!File::isDirectory($modelPath)) {
            File::makeDirectory($modelPath, 0755, true);
        }

        // Generate the controller file name
        $fileName = $modelName . '.php';

        // Generate the controller file content using a stub
        $stubPath = base_path('/modules/Core/Console/Commands/stubs/modules/model.stub');
        $stubContent = File::get($stubPath);

        $string = $stubContent;
        $search = array('{{moduleName}}', '{{modelName}}');
        $replace = array($moduleName, $modelName);
        $stubContent = str_replace($search, $replace, $string);

        // Save the controller file
        $filePath = $modelPath . '/' . $fileName;
        File::put($filePath, $stubContent);

        $output = null;

        $this->info("Model created successfully: {$fileName}");
    }

}
