<?php

namespace Modules\Core\Http\Controllers;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (auth()->check()) {
            // User is logged in, show logged-in view
            return view('core::home');
        } else {
            // User is not logged in, show not logged-in view
            return view('core::welcome');
        }
    }

}
