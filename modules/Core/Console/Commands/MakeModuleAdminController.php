<?php

namespace Modules\Core\Console\Commands;

use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Support\Composer;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModuleAdminController extends Command {

    protected $signature = 'core:module:make:admincontroller {moduleName : The name of the module} {controllerName : The name of the controller}';
    protected $description = 'Create a new admin controller for a module';

    public function handle() {
        $moduleName = $this->argument('moduleName');
        $controllerName = $this->argument('controllerName');

        // Check if the module directory exists
        if (!File::isDirectory(base_path("modules/{$moduleName}"))) {
            $this->error("Module {$moduleName} does not exist.");
            return;
        }

        // Create the controllers directory if it doesn't exist
        $controllerPath = base_path("modules/{$moduleName}/Http/Controllers/Admin");
        if (!File::isDirectory($controllerPath)) {
            File::makeDirectory($controllerPath, 0755, true);
        }

        // Generate the controller file name
        $fileName = $controllerName . '.php';

        // Generate the controller file content using a stub
        $stubPath = base_path('/modules/Core/Console/Commands/stubs/admincontroller.stub');
        $stubContent = File::get($stubPath);

        $string = $stubContent;
        $moduleLower = lcfirst($moduleName);
        $search = array('{{moduleName}}', '{{controllerName}}', '{{moduleNameLower}}');
        $replace = array($moduleName, $controllerName, $moduleLower);
        $stubContent = str_replace($search, $replace, $string);

        // Save the controller file
        $filePath = $controllerPath . '/' . $fileName;
        File::put($filePath, $stubContent);

        $output = null;

        $this->info("Controller created successfully: {$fileName}");
    }

}
