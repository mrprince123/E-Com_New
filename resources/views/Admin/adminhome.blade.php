@extends('Admin.admin')
@push('title')
    <title>Admin Home</title>
@endpush

@section('main-content')
    <div class="m-2 p-2 bg-slate-100 rounded-xl">



        <div class="w-full flex gap-2">
            <div class="w-1/4 bg-white border border-slate-300 p-3 rounded-xl shadow-lg">
                <div class="flex justify-between items-center p-2 text-xl">
                    <h2 class="font-medium text-slate-700">Users</h2>
                    <i class="fa-solid bg-purple-200 p-2 rounded-lg fa-users p-2 text-purple-500"></i>
                </div>


                <h2 class="text-black font-bold text-2xl p-2">
                    @php
                        echo count($user);
                    @endphp
                </h2>
            </div>
            <div class="w-1/4 bg-white border border-slate-300 p-3 rounded-xl shadow-lg">
                <div class="flex justify-between items-center p-2 text-xl">
                    <h2 class="font-medium text-slate-700">Products</h2>
                    <i class="fa-solid bg-purple-200 p-2 rounded-lg fa-bag-shopping p-2 text-purple-500"></i>
                </div>
                <h2 class="text-black font-bold text-2xl p-2"> @php
                    echo count($product);
                @endphp</h2>
            </div>
            <div class="w-1/4 bg-white border border-slate-300 p-3 rounded-xl shadow-lg">
                <div class="flex justify-between items-center p-2 text-xl">
                    <h2 class="font-medium text-slate-700">Orders</h2>
                    <i class="fa-solid bg-purple-200 p-2 rounded-lg fa-square-poll-vertical p-2 text-purple-500"></i>
                </div>
                <h2 class="text-black font-bold text-2xl p-2">
                    @php
                        echo count($order);
                    @endphp
                </h2>
            </div>
            <div class="w-1/4 bg-white border border-slate-300 p-3 rounded-xl shadow-lg">
                <div class="flex justify-between items-center p-2 text-xl">
                    <h2 class="font-medium text-slate-700">Carts</h2>
                    <i class="fa-solid bg-purple-200 p-2 rounded-lg fa-cart-plus p-2 text-purple-500"></i>
                </div>
                <h2 class="text-black font-bold text-2xl p-2">
                    @php
                        echo count($cart);
                    @endphp
                </h2>
            </div>
        </div>





    </div>
@endsection
