<?php

namespace Modules\Bookable\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\LazyCollection;
use Modules\Core\Http\Controllers\Controller;
use Modules\Bookable\Models\Bookable;
use Modules\Bookable\Models\BookableState;

class BookableController extends Controller {

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index() {
        $bookables = Bookable::all();
        return view('bookable-admin::index', compact('bookables'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create() {
        return view('bookable-admin::create', [
            'bookable' => app(Bookable::class),
            'states' => BookableState::choices()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|min:2|max:255',
            'sku' => 'nullable|unique:products',
            'state' => ['required', Rule::in(BookableState::values())],
            'price' => 'nullable|numeric',
            'original_price' => 'sometimes|nullable|numeric',
            'images' => 'nullable',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,pjpg,png,gif,webp'
        ]);

        $bookable = Bookable::create($request->except('images'));
        if ($request->has('images')) {
            $bookable->addMultipleMediaFromRequest(['images'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection();
            });
        }
        return redirect()->route('bookables.admin.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Bookable $bookable) {
        return view('bookable-admin::show', [
            'bookable' => $bookable
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Bookable $bookable) {
        return view('bookable-admin::edit', [
            'bookable' => $bookable,
            'states' => BookableState::choices()
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Bookable $bookable) {
        $request->validate([
            'name' => 'required|min:2|max:255',
            'sku' => 'nullable|unique:products',
            'state' => ['required', Rule::in(BookableState::values())],
            'price' => 'nullable|numeric',
            'original_price' => 'sometimes|nullable|numeric',
            'images' => 'nullable',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,pjpg,png,gif,webp'
        ]);

        $bookable->update($request->except('images'));

        return back()->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Bookable $bookable) {
        //
    }

}
