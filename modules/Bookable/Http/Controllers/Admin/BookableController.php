<?php

namespace Modules\Bookable\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\LazyCollection;
use Modules\Core\Http\Controllers\Controller;
use Modules\Bookable\Contracts\Requests\CreateBookable;
use Modules\Bookable\Contracts\Requests\UpdateBookable;
use Modules\Bookable\Contracts\Bookable;
use Modules\Bookable\Models\BookableProxy;
use Modules\Bookable\Models\BookableState;

class BookableController extends Controller {

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index() {
        $bookables = BookableProxy::all();
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
    public function store(CreateBookable $request) {
        try {
            $bookable = BookableProxy::create($request->except('images'));
            flash()->success(__(':name has been created', ['name' => $bookable->name]));

            try {
                if (!empty($request->files->filter('images'))) {
                    $bookable->addMultipleMediaFromRequest(['images'])->each(function ($fileAdder) {
                        $fileAdder->toMediaCollection();
                    });
                }
            } catch (\Exception $e) { // Here we already have the service created
                flash()->error(__('Error: :msg', ['msg' => $e->getMessage()]));

                return redirect()->route('bookables.admin.edit', ['bookable' => $bookable]);
            }
        } catch (\Exception $e) {
            flash()->error(__('Error: :msg', ['msg' => $e->getMessage()]));

            return redirect()->back()->withInput();
        }
        return redirect()->route('bookables.admin.index');
    }

    /**
     * Show the specified resource.
     * @param int $bookable
     * @return Renderable
     */
    public function show(Bookable $bookable) {
        return view('bookable-admin::show', [
            'bookable' => $bookable
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $bookable
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
     * @param int $bookable
     * @return Renderable
     */
    public function update(Bookable $bookable, UpdateBookable $request) {
        try {
            $bookable->update($request->all());

            flash()->success(__(':name has been updated', ['name' => $bookable->name]));
        } catch (\Exception $e) {
            flash()->error(__('Error: :msg', ['msg' => $e->getMessage()]));

            return redirect()->back()->withInput();
        }

        return back()->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $bookable
     * @return Renderable
     */
    public function destroy(Bookable $bookable) {
        try {
            $name = $bookable->name;
            $bookable->delete();

            flash()->warning(__(':name has been deleted', ['name' => $name]));
        } catch (\Exception $e) {
            flash()->error(__('Error: :msg', ['msg' => $e->getMessage()]));

            return redirect()->back();
        }

        return redirect(route('bookables.admin.index'));
    }

}
