<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order as RequestsOrder;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class OrderController extends Controller
{

    public function indexAdmin()
    {
        $orders = Order::all();
        return view('Admin.order', compact('orders'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Make a view to show all the orders 
        $auth = Auth::id();
        $orders = Order::where('user_id', $auth)->get();
        return view('order', compact('orders'));
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
        //
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
    public function edit(string $orderId)
    {
        $order = Order::find($orderId);
        return view('orderEdit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RequestsOrder $request, string $orderId)
    {
        // save from id 
        $newOrder = Order::find($orderId);
        $newOrder->order_status = $request['order_status'];
        $newOrder->payment_status = $request['payment_status'];
        $newOrder->save();

        // redirect
        return redirect('/admin/order')->withMessage(Lang::get('order.update'));
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

        return redirect('/admin/order');

    }
}
