<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\User\Models\User;
use Modules\Profile\Models\Profile;

class UserController extends Controller {

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function account() {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id) -> first();;
        return view('user::account.index', ['user' => $user, 'profile' => $profile]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function avatar() {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id) -> first();
        return view('user::account.avatar', ['user' => $user, 'profile' => $profile]);
    }
    
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function accountSecurity() {
        $user = Auth::user();
        return view('user::account.security', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id) {
        // Get current user
        $user = User::findOrFail($id);
        $data = $request->all();
        
        // Update user
        $user->update($data);

        // Redirect to route
        return redirect()->route('user.account');
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
