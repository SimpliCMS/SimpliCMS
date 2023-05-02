<?php

namespace Modules\Profile\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Konekt\User\Contracts\Avatar;
use Modules\User\Models\User;
use Modules\Profile\Models\Profile;

class ProfileController extends Controller {

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index() {
        return view('profile::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function settingsIndex() {
                $user = Auth::user();
        $profile = Profile::where('user_id', $user->id) -> first();;
        return view('profile::settings.index', ['user' => $user, 'profile' => $profile]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store() {
        
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id) {
        return view('profile::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id) {
        return view('profile::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request) {
        $request->validate([
            'avatar' => 'required|image',
        ]);

        $avatarName = time() . '.' . $request->avatar->getClientOriginalExtension();
        $request->avatar->move(storage_path('app/public/avatars'), $avatarName);

        Auth()->user()->profile->update(['avatar_type' => 'storage', 'avatar_data' => 'app/storage/app/public/avatars/'.$avatarName]);

        return back()->with('success', 'Avatar updated successfully.');
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
