@extends('Layout.app')
@push('title')
    <title>Order Placed Successfully</title>
@endpush

@section('body')
    <div class="mt-10 mb-10 flex items-center rounded-full flex-col">
        <img class="h-64 object-cover"
            src="https://img.freepik.com/free-vector/upgrade-concept-illustration_114360-5231.jpg?t=st=1714995347~exp=1714998947~hmac=b2f6276909950d9ca6ae01d75edda1bc1bc87c5b7e7ef74a1db137443cb0fc55&w=740"
            alt="">
        <h1 class="font-bold text-xl text-center">Order Placed Successfully</h1>
        <div class="mt-5">
            @php
                $userId = Auth::id();
            @endphp
            <a class="p-2 m-2 rounded-xl border-2 border-yellow-500" href="{{ url('/profile/' . $userId) }}">View Orders</a>
            <a class="p-2 m-2 bg-yellow-500 rounded-xl" href="{{ url('/') }}">Continue Shopping</a>
        </div>
    </div>
@endsection
