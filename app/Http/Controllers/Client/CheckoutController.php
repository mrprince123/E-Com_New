<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Stripe;

class CheckoutController extends Controller
{
    /**
     * To show the Successfull Page Order Placed
     */

    public function success()
    {
        return view('orderPlaced');
    }

    public function paymentType(Request $request)
    {
        if ($request->payment_type == 'online') {
            $userId = Auth::id();
            // where user_id matched the login user id
            $cart = Cart::all()->where('user_id', $userId);
            $address = Address::all()->where('user_id', $userId);
            return view('stipePaymentCheckout', compact('cart', 'address'));
        } else {
            return redirect('/checkout'); // Another Checkout type
        }

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        // where user_id matched the login user id
        $cart = Cart::all()->where('user_id', $userId);
        $address = Address::all()->where('user_id', $userId);
        return view('checkout', compact('cart', 'address'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Taking the Address from the Auth
        $userId = Auth::id();

        $request->validate([
            'address_id' => 'required',
            'total_amount' => 'required',
            'payment_mode' => 'required',
        ]);

        if ($request->payment_mode == "online") {
            // dd($request['stripeToken']);

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            Stripe\Charge::create([
                "amount" => $request['total_amount'],
                "currency" => "usd",
                "source" => $request['stripeToken'],
                "description" => "Done by Developer"
            ]);
        }



        $order = new Order();
        $order->user_id = $userId;
        $order->address_id = $request['address_id'];
        $order->total_amount = $request['total_amount']; // get from the stipe.
        $order->payment_mode = $request['payment_mode'];

        // also get the payment id from stipe
        $order->order_status = 'pending'; // Get this from the Stipe
        $order->payment_status = 'unpaid'; // Get this from the stripe
        $order->save();

        return redirect('/order/successfully')->withMessage(Lang::get('order.success'));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $orderId)
    {

        $order = Order::find($orderId);

        if (!is_null($order)) {
            $order->delete();
        }

        return redirect()->back()->withMessage(Lang::get('order.cancel'));

    }
}
