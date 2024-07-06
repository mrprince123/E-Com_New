<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth as RequestsAuth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    // showing the Register View
    public function register()
    {
        return view('Auth.register');
    }

    // Showing the Login View
    public function login()
    {
        return view('Auth.login');
    }

    // Logic For Register new User
    public function userRegister(RequestsAuth $request)
    {
        $imagePath = $request->file('profilePic')->store('images', 'public');

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'profilePic' => $imagePath,
            'password' => Hash::make($request['password']),
            'confirm_password' => Hash::make($request['confirm_password'])
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('');
        }

        // Now Redirect Anywhere eles
        return redirect('/')->with('message', Lang::get('auth.register'));
    }

    public function userLogin(Request $request)
    {
        // For validation when users wants to login
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:8'
        ]);

        // Check if the User exists
        $email = $request['email'];
        $emailExists = User::find($email);
        if (!$emailExists) {
            redirect('/login')->with('message', Lang::get('auth.failed'));
        }

        // if user Does not exists
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('')->with('message', Lang::get('auth.login'));
        } else {
            return redirect('/login')->with('message', Lang::get('auth.password'));
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('')->with('message', Lang::get('auth.logout'));
    }
}