@extends('Layout.app')
@push('title')
    <title>Product Update</title>
@endpush

@section('body')
    <div class="mt-10 mb-10">

        <h1 class="text-blue-500 font-bold text-xl text-center mb-5">Order Edit Page</h1>
        <form class="p-2 m-2 rounded-xl flex flex-col shadow-xl" action="{{ url('/update/order/' . $order->id) }}"
            method="post">
            @csrf
            @method('PUT')

            <label for="order_status" class="font-semibold mb-2">Order Status</label>
            <select name="order_status" class="p-2 rounded-lg bg-slate-100 mb-2">
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>

            <label for="payment_status" class="font-semibold mb-2">Order Status</label>
            <select name="payment_status" class="p-2 rounded-lg bg-slate-100 mb-2">
                <option value="paid">Paid</option>
                <option value="unpaid">Unpaid </option>
            </select>


            <input type="submit" class="bg-blue-500 text-white font-semibold rounded-xl p-2 cursor-pointer"
                value="Update Profile">
        </form>

    </div>
@endsection
