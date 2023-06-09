<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;
class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    private $theme;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        JavaScript::put([
            'baseURL' => url('/'),
            'domain' => request()->getHttpHost()
        ]);
    }

}
