<?php

namespace Modules\Shop\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Konekt\User\Contracts\Avatar;
use Modules\User\Models\User;
use Konekt\Customer\Contracts\Customer;
use Modules\Profile\Models\Profile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ShopProfileController extends Controller {

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function settings() {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();
        return view('shop::profile.settings.index', ['user' => $user, 'profile' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request) {
        
    }

}
