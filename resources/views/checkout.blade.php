@extends('Layout.app')
@push('title')
    <title>Checkout</title>
@endpush

@section('body')
    <div class="flex flex-col mt-20 mb-20">

        @php
            $totalPrice = 0;
            $cartCount = count($cart);
        @endphp

        <h1 class="text-black font-semibold text-xl m-2">Final Checkout Page <span class="text-sm text-slate-500">(
                {{ $cartCount }} Products )</span></h1>
        <div class="flex">
            <div class="w-2/3">

                @forelse ($cart as $item)
                    @php
                        $productId = $item->product_id;
                        $product = App\Models\Product::find($productId);
                    @endphp
                    @if ($product)
                        {{-- Product One  --}}
                        <div class="flex gap-2 p-2 bg-slate-100 m-2 rounded-xl shadow-xl">
                            <img class="rounded-xl w-96 h-64 object-cover"
                                src="{{ asset('storage/' . $product->product_pic) }}" alt="">
                            <div>
                                <p class="text-blue-500 font-bold">{{ $product->name }}</p>
                                <p class="text-slate-700">{{ $product->description }}</p>
                                <div class="flex items-center">
                                    {{-- Adding all the Prices  --}}
                                    @php
                                        $productPrice = $item->quantity * $product->price;
                                        $totalPrice += $productPrice;
                                    @endphp
                                    <p class="text-black font-bold">{{ $product->price }}</p>
                                    <p class="bg-yellow-200 text-yellow-500 font-medium text-sm rounded-lg p-1 m-2">50% off
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <p>Cart is Empty !! No Product Found</p>
                    @endif
                @empty
                @endforelse

            </div>


            {{-- Other Side Payment and Coupon --}}
            <div class="w-1/3 rounded-xl  m-2 h-auto flex flex-col gap-2">


                <div class="p-2 rounded-xl shadow-xl bg-slate-100">
                    <h1 class="text-xl font-bold text-black">Coupon Code</h1>
                    <p class="text-slate-500">If you have coupon code please enter your coupon code below to get extra
                        discount
                        on your total purchase.</p>

                    <form action="" method="post">
                        <input class="bg-slate-200 mt-5 p-2 w-full rounded-xl" placeholder="Coupon Code">
                        <input type="submit" class="bg-black w-full mt-2 p-2 text-white font-semibold rounded-xl"
                            value="Apply">

                    </form>

                </div>

                <div class="p-2 rounded-xl shadow-xl bg-slate-100">
                    <h1 class="text-xl font-bold text-black mb-5">Order Summery</h1>
                    <div class="flex justify-between">
                        <p class="text-slate-500 font-semibold">Bag Total</p>
                        <p class="text-slate-900 font-semibold">@php
                            echo $totalPrice;
                        @endphp</p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-slate-500 font-semibold">Bag Discount <span
                                class="text-yellow-500 font-semibold">(10%)</span>
                        </p>
                        <p class="text-slate-900 font-semibold">@php

                            $discountedPrice = $totalPrice / 10;
                            echo floor($discountedPrice);

                        @endphp</p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-slate-500 font-semibold">Delivery Fee</p>
                        <p class="text-slate-900 font-semibold">00.00</p>
                    </div>
                    <div class="flex justify-between mt-5">
                        <p class="text-yellow-500 text-xl font-bold">Bag Total</p>
                        {{-- This is the Grand Total  --}}
                        <p class="text-yellow-500 text-xl font-bold">@php
                            $grandTotalPrice = $totalPrice - $discountedPrice;
                            echo '₹' . floor($grandTotalPrice);
                        @endphp</p>
                    </div>
                </div>

                <div class="p-2 rounded-xl shadow-xl bg-yellow-300 ">
                    <h1 class="text-xl font-bold text-black">Payment Mode</h1>
                    <p class="text-slate-500 mb-5">Please select your convenient Payment mode.</p>

                    <form action="{{ url('/store/order/checkout') }}" method="post">
                        @csrf

                        <label for="address_id" class="font-bold">Select Deliver Address</label>
                        <select name="address_id" class="p-2 bg-white rounded-xl w-full mt-2">
                            @forelse ($address as $item)
                                <option value="{{ $item->id }}">{{ $item->locality }}, {{ $item->city }}</option>
                                <option value="">No Found</option>
                            @empty
                                <p>No Address found</p>
                            @endforelse
                        </select>
                        @error('address_id')
                            <p class="text-red-500 text-center font-semibold">{{ $message }}</p>
                        @enderror
                        <input type="text" name="total_amount" hidden class="bg-slate-200 mt-2 p-2 w-full rounded-xl"
                            readonly value="{{ floor($grandTotalPrice) }}">
                        <label for="address_id" class="font-bold">Payment Mode</label>

                        <select name="payment_mode" readonly class="bg-slate-200 mt-2 p-2 w-full rounded-xl">
                            <option value="cod">Cash On Delivery</option>
                            {{-- <option value="online">Online Online</option> --}}
                        </select>

                        <input type="submit" class="bg-black w-full mt-2 p-2 text-white font-semibold rounded-xl"
                            value="Final Checkout">
                    </form>


                </div>

            </div>
        </div>


    </div>
@endsection
