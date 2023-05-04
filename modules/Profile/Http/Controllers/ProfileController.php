<?php

namespace Modules\Profile\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Konekt\User\Contracts\Avatar;
use Modules\User\Models\User;
use Modules\Profile\Models\Profile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $profile = Profile::where('user_id', $user->id)->first();
        return view('profile::settings.index', ['user' => $user, 'profile' => $profile]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function settingsInfo() {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();
        return view('profile::settings.info', ['user' => $user, 'profile' => $profile]);
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
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request) {
        $user = Auth::user();
        $request->validate([
            'birthdate' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:255',
        ]);

        $profile = Profile::where('user_id', $user->id)->first();
        if ($request->input('gender') == 'm') {
            $gender = 'Male';
        } elseif ($request->input('gender') == 'f') {
            $gender = 'Female';
        } else {
            $gender = null;
        }

        $profile->person->birthdate = $request->input('birthdate');
        $profile->person->gender = $request->input('gender');
        $profile->person->gender_value = $gender;
        $profile->person->bio = $request->input('bio');
        $profile->person->save();
        return back()->with('success', 'Profile updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function updateAvatar(Request $request) {
        $user = Auth::user();

        $request->validate([
            'avatar' => 'required|image',
        ]);

        $profile = Profile::where('user_id', $user->id)->first();

        // Delete previous avatar file if it exists
        if ($profile && $profile->avatar_data) {
            $avatarPath = str_replace('app/storage/', '', $profile->avatar_data);
            unlink(storage_path($avatarPath));
            rmdir(storage_path('app/public/avatars/' . $user->id));
        }

        $avatarContent = file_get_contents($request->avatar->getRealPath());
        $avatarHash = hash('sha256', $avatarContent);
        $avatarExtension = $request->avatar->getClientOriginalExtension();

        $avatarName = $avatarHash . '.' . $avatarExtension;
        $request->avatar->move(storage_path('app/public/avatars/' . $user->id), $avatarName);

        $user->profile->update(['avatar_type' => 'storage', 'avatar_data' => 'app/storage/app/public/avatars/' . $user->id . '/' . $avatarName]);

        return back()->with('success', 'Avatar updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function deleteAvatar(Request $request) {
        $user = Auth::user();

        $profile = Profile::where('user_id', $user->id)->first();
        // Delete previous avatar file if it exists
        if ($profile && $profile->avatar_data) {
            $avatarPath = str_replace('app/storage/', '', $profile->avatar_data);
            unlink(storage_path($avatarPath));
            rmdir(storage_path('app/public/avatars/' . $user->id));
        }

        $user->profile->update(['avatar_type' => 'gravatar', 'avatar_data' => null]);

        return back()->with('success', 'Avatar deleted successfully.');
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
