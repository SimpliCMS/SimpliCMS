<?php

namespace Modules\Core\Http\Controllers\Installer;

use Illuminate\Routing\Controller;
use Modules\Core\Events\InstallerFinished;
use Modules\Core\Helpers\EnvironmentManager;
use Modules\Core\Helpers\FinalInstallManager;
use Modules\Core\Helpers\InstalledFileManager;

class FinalController extends Controller
{
    /**
     * Update installed file and display finished view.
     *
     * @param \Modules\Core\Helpers\InstalledFileManager $fileManager
     * @param \Modules\Core\Helpers\FinalInstallManager $finalInstall
     * @param \Modules\Core\Helpers\EnvironmentManager $environment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function finish(InstalledFileManager $fileManager, FinalInstallManager $finalInstall, EnvironmentManager $environment)
    {
        $finalMessages = $finalInstall->runFinal();
        $finalStatusMessage = $fileManager->update();
        $finalEnvFile = $environment->getEnvContent();

        event(new InstallerFinished);

        return view('vendor.installer.finished', compact('finalMessages', 'finalStatusMessage', 'finalEnvFile'));
    }
}
