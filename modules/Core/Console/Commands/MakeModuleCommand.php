<?php

namespace Modules\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MakeModuleCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'core:make:module {name : The name of the module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a module.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $moduleName = $this->argument('name');
        $modulePath = base_path('modules/' . $moduleName);

        // Create the module directory if it doesn't exist
        if (!File::exists($modulePath)) {
            File::makeDirectory($modulePath, 0755, true);
            File::makeDirectory($modulePath . '/Http', 0755, true);
            File::makeDirectory($modulePath . '/Http/Controllers', 0755, true);
            File::makeDirectory($modulePath . '/Http/Middleware', 0755, true);
            File::makeDirectory($modulePath . '/Http/Requests', 0755, true);
            File::makeDirectory($modulePath . '/Providers', 0755, true);
            File::makeDirectory($modulePath . '/resources', 0755, true);
            File::makeDirectory($modulePath . '/resources/config', 0755, true);
            File::makeDirectory($modulePath . '/resources/database', 0755, true);
            File::makeDirectory($modulePath . '/resources/database/migrations', 0755, true);
            File::makeDirectory($modulePath . '/resources/database/seeds', 0755, true);
            File::makeDirectory($modulePath . '/resources/routes', 0755, true);
            File::makeDirectory($modulePath . '/resources/views', 0755, true);
            File::makeDirectory($modulePath . '/resources/views/themes', 0755, true);
            File::makeDirectory($modulePath . '/resources/views/themes/admin', 0755, true);
            File::makeDirectory($modulePath . '/resources/views/themes/default', 0755, true);
        }

        // Create the ModuleServiceProvider.php file using the stub
        $moduleserviceproviderstub = $this->getStub('module-service-provider.stub');
        $moduleserviceproviderstub = str_replace('{module}', $moduleName, $moduleserviceproviderstub);
        File::put($modulePath . '/Providers/ModuleServiceProvider.php', $moduleserviceproviderstub);

        // Create the RouteServiceProvider.php file using the stub
        $routeserviceproviderstub = $this->getStub('route-service-provider.stub');
        $routeserviceproviderstub = str_replace('{module}', $moduleName, $routeserviceproviderstub);
        File::put($modulePath . '/Providers/RouteServiceProvider.php', $routeserviceproviderstub);

        // Create the PluginServiceProvider.php file using the stub
        $pluginserviceproviderstub = $this->getStub('plugin-service-provider.stub');
        $pluginserviceproviderstub = str_replace('{module}', $moduleName, $pluginserviceproviderstub);
        File::put($modulePath . '/Providers/PluginServiceProvider.php', $pluginserviceproviderstub);

        // Create the AdminMenuServiceProvider.php file using the stub
        $adminmenuserviceproviderstub = $this->getStub('admin-menu-service-provider.stub');
        $adminmenuserviceproviderstub = str_replace('{module}', $moduleName, $adminmenuserviceproviderstub);
        File::put($modulePath . '/Providers/AdminMenuServiceProvider.php', $adminmenuserviceproviderstub);

        // Create the SettingsServiceProvider.php file using the stub
        $settingsserviceproviderstub = $this->getStub('module-settings-service-provider.stub');
        $settingsserviceproviderstub = str_replace('{module}', $moduleName, $settingsserviceproviderstub);
        File::put($modulePath . '/Providers/'.$moduleName.'SettingsServiceProvider.php', $settingsserviceproviderstub);

        // Create the route files using the stubs
        $routeadminstub = $this->getStub('routes-admin.stub');
        $routeadminstub = str_replace('{module}', $moduleName, $routeadminstub);
        File::put($modulePath . '/resources/routes/admin.php', $routeadminstub);

        $routeapistub = $this->getStub('routes-api.stub');
        $routeapistub = str_replace('{module}', $moduleName, $routeapistub);
        File::put($modulePath . '/resources/routes/api.php', $routeapistub);

        $routewebstub = $this->getStub('routes-web.stub');
        $routewebstub = str_replace('{module}', $moduleName, $routewebstub);
        $routewebstub = str_replace('{moduleLower}', strtolower($moduleName), $routewebstub);
        File::put($modulePath . '/resources/routes/web.php', $routewebstub);

        // Create the module manifest using the stub
        $manifeststub = $this->getStub('module-manifest.stub');
        $manifeststub = str_replace('{module}', $moduleName, $manifeststub);
        File::put($modulePath . '/resources/manifest.php', $manifeststub);

        // Create the module composer file using the stub
        $composerstub = $this->getStub('composer.stub');
        $composerstub = str_replace('{module}', $moduleName, $composerstub);
        $composerstub = str_replace('{moduleLower}', strtolower($moduleName), $composerstub);
        File::put($modulePath . '/composer.json', $composerstub);

        // Output success message
        $this->info("Module [$moduleName] created successfully.");
    }

    /**
     * Get the contents of a stub file.
     *
     * @param  string  $stubName
     * @return string
     */
    protected function getStub($stubName) {
        $stubPath = base_path('/modules/Core/Console/Commands/stubs/' . $stubName);
        if (!File::exists($stubPath)) {
            $this->error("Stub [$stubName] not found.");
            return false;
        }
        return File::get($stubPath);
    }

}
