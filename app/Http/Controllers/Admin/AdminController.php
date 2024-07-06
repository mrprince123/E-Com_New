<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAuth;
use App\Models\Address;
use App\Models\AdminModel;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    // Show the details about the Admins
    public function indexAdmin()
    {
        $users = User::all();
        return view('Admin.user', compact('users'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::all();
        $address = Address::all();
        $user = User::all();
        $order = Order::all();
        $orderItem = OrderItems::all();
        $product = Product::all();

        return view('Admin.adminhome', compact('cart', 'address', 'user', 'order', 'orderItem', 'product'));
    }

    // Show the Admin Login Page
    public function adminLogin()
    {
        return view('Admin.Auth.adminLogin');
    }

    // Show the Admin Register Page 
    public function adminRegister()
    {
        return view('Admin.Auth.adminRegister');

    }

    // Taking the Data from the Admin Login Page
    public function loginPostAdmin(Request $request)
    {

        // Validate all the Request comming
        $request->validate([
            'email' => "required",
            'password' => 'required',
        ]);

        // if user Does not exists
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.home')->withMessage(Lang::get('admin.login_success'));
        } else {
            return redirect()->route('admin.login')->withMessage(Lang::get('admin.login_failed'));
        }

    }

    // Take the Data from the Admin Register Page 
    public function registerPostAdmin(AdminAuth $request)
    {

        $adminProfilePath = $request->file('adminProfilePic')->store('images', 'public');

        AdminModel::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'adminProfilePic' => $adminProfilePath,
            'phone' => $request['phone'],
            'password' => Hash::make($request->password),
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.home')->withMessage(Lang::get('admin.success'));
        } else {
            return redirect()->route('admin.login')->withMessage(Lang::get('admin.invalid'));
        }
    }

    // For Admin Register 
    public function logout()
    {
        // Logic for Session Removing
        Session::guard('admin')->flush();
        Auth::guard('admin')->logout();
        return redirect('')->withMessage(Lang::get('admin.logout'));
    }
}
