<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Core\Models\Page;
use Modules\Core\Http\Controllers\Controller;

class PageController extends Controller {

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($slug) {
        $page = Page::where('slug', $slug)->first();
        return view('core::pages.show', compact('page'));
    }

}
