<?php

namespace Modules\Core\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Core\Models\Page;
use Modules\Core\Http\Controllers\Controller;

class PageController extends Controller {

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index() {
        $pages = Page::all();
        return view('core-admin::pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create() {
        return view('core-admin::pages.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request) {
        $request->validate([
            'content' => 'nullable|string|min:3',
        ]);

        $page = Page::create($request->only(['title', 'slug', 'content']));

        return redirect()->route('pages.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id) {
        return view('core-admin::pages.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Page $page) {
        return view('core-admin::pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Page $page) {
        $request->validate([
            'content' => 'nullable|string|min:3',
        ]);

        $page->update($request->only(['title', 'slug', 'content']));

        return back()->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id) {
        //
    }

}
