<?php

namespace Modules\Core\Console\Commands;

use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Support\Composer;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModuleProvider extends Command {

    protected $signature = 'core:module:make:provider {moduleName : The name of the module} {providerName : The name of the provider}';
    protected $description = 'Create a new service provider for a module';

    public function handle() {
        $moduleName = $this->argument('moduleName');
        $providerName = $this->argument('providerName');

        // Check if the module directory exists
        if (!File::isDirectory(base_path("modules/{$moduleName}"))) {
            $this->error("Module {$moduleName} does not exist.");
            return;
        }

        // Create the providers directory if it doesn't exist
        $providersPath = base_path("modules/{$moduleName}/Providers");
        if (!File::isDirectory($providersPath)) {
            File::makeDirectory($providersPath, 0755, true);
        }

        // Generate the provider file name
        $fileName = $providerName . '.php';

        // Generate the provider file content using a stub
        $stubPath = base_path('/modules/Core/Console/Commands/stubs/provider.stub');
        $stubContent = File::get($stubPath);
        $string = $stubContent;
        $search = array('{{moduleName}}', '{{providerName}}');
        $replace = array($moduleName, $providerName);
        $stubContent = str_replace($search, $replace, $string);
        // Save the provider file
        $filePath = $providersPath . '/' . $fileName;
        File::put($filePath, $stubContent);

        $this->info("Service Provider created successfully: {$fileName}");
    }

}
