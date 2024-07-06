<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth as RequestsAuth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

class ProfileController extends Controller
{
    public function profileData(string $profileId)
    {
        // $profile = User::find( $profileId )->with( 'address' )->with( 'orders' )->get();
        $profile = User::with('address', 'orders')->find($profileId);
        return view('profile', compact('profile'));
    }

    public function profileDelete(string $profileId)
    {
        $profile = User::find($profileId);
        if (!is_null($profile)) {
            $profile->delete();
        }

        return redirect('');
    }

    public function profileEdit(string $profileId)
    {
        $user = User::find($profileId);
        return view('profileEdit', compact('user'));
    }

    public function profileUpdate(RequestsAuth $request, string $profileId)
    {
        $profileUpdate = User::find($profileId);

        $imagePath = $request->file('profilePic')->store('images', 'public');

        $profileUpdate->name = $request['name'];
        $profileUpdate->email = $request['email'];
        $profileUpdate->phone = $request['phone'];
        $profileUpdate->profilePic = $imagePath;
        $profileUpdate->password = Hash::make($request['password']);
        $profileUpdate->confirm_password = Hash::make($request['confirm_password']);
        $profileUpdate->save();

        // Send Message after the update is done successfully
        return redirect('/')->with(Lang::get('auth.profile_update'));
    }
}
