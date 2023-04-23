<?php

namespace Modules\Admin\Http\Controllers;

use Modules\Core\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller {

    public function index() {
        return view('admin::index', [
            'user' => Auth::user()
        ]);
    }

}
