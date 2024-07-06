<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address as RequestsAddress;
use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class AddressController extends Controller
{

    public function indexAdmin()
    {
        $address = Address::all();
        return view('Admin.address', compact('address'));
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $address = Address::all();
        return view('address', compact('address'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('address');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(RequestsAddress $request)
    {
        try {
            // $address = new Address();
            // $address->name = $request['name'];
            // $address->phone = $request['phone'];
            // $address->user_id = $userId;
            // $address->locality = $request['locality'];
            // $address->city = $request['city'];
            // $address->state = $request['state'];
            // $address->country = $request['country'];
            // $address->pincode = $request['pincode'];
            // $address->save();
            // Getting the ID from the Auth
            $userId = Auth::id();
            // dd($userId);

            Address::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'user_id' => $userId,
                'locality' => $request->locality,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'pincode' => $request->pincode
            ]);

            dd($userId);

            return redirect()->back()->withMessage(Lang::get('address.success'));
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    /**
     * Display the specified resource.
     */

    public function show(string $addressId)
    {
        $address = Address::find($addressId);
        return view('viewName', compact('address'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(string $addressId)
    {
        $address = Address::find($addressId);
        return view('Admin.addressEdit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(RequestsAddress $request, string $addressId)
    {

        $newUpdatedaddress = Address::find($addressId);
        $newUpdatedaddress->name = $request['name'];
        $newUpdatedaddress->phone = $request['phone'];
        $newUpdatedaddress->locality = $request['locality'];
        $newUpdatedaddress->city = $request['city'];
        $newUpdatedaddress->state = $request['state'];
        $newUpdatedaddress->country = $request['country'];
        $newUpdatedaddress->pincode = $request['pincode'];
        $newUpdatedaddress->save();

        return redirect()->back()->withMessage(Lang::get('address.update'));
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $addressId)
    {
        $address = Address::find($addressId);
        if (!is_null($address)) {
            $address->delete();
        }
        // return redirect('/');
        //   return  Redirect::back()->with('message', 'Address Deleted Successfully');

        return redirect()->back()->withMessage(Lang::get('address.delete'));

    }
}
