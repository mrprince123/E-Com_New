@extends('Layout.app')
@push('title')
    <title>Cart</title>
@endpush

@section('body')
    <div class="flex flex-col mt-20 mb-20">

        @php
            $totalPrice = 0;
            $cartCount = count($cart);
        @endphp

        <h1 class="text-black font-semibold text-xl m-2">Your Cart <span class="text-sm text-slate-500">(
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
                            <img class="rounded-xl w-96 h-48 object-cover"
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
                                    <p class="text-black font-bold">₹{{ $product->price }}</p>
                                    <p
                                        class="bg-yellow-200 text-yellow-600 text-center font-medium text-sm rounded-md p-1 m-2">
                                        50% off
                                    </p>
                                </div>
                                <a href="{{ url('/delete/cart/' . $item->id) }}"
                                    class="bg-black text-sm text-yellow-500 font-semibold p-1 rounded-md">Remove from
                                    Cart</a>
                                <p class="mt-2 font-semibold">Quantity:</p>

                                {{-- Here This is the Quantity Update Feature  --}}
                                <form class="flex justify-between items-center w-24"
                                    action="{{ url('/update/cart/' . $item->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button class="font-semibold w-8 border-2 border-slate-500 p-1 rounded-md"
                                        type="submit" name="quantity" value="{{ $item->quantity - 1 }}">-</button>
                                    <p class="font-semibold p-2 w-8 text-center rounded-lg">{{ $item->quantity }}</p>
                                    <button class="font-semibold w-8 border-2 border-slate-500 p-1 rounded-md"
                                        type="submit" name="quantity" value="{{ $item->quantity + 1 }}">+<button>
                                </form>
                            </div>
                        </div>
                    @else
                    @endif
                @empty
                    <div class="p-2 m-2 rounded-xl bg-slate-200">
                        <img class="w-full rounded-xl h-96 object-cover"
                            src="https://t4.ftcdn.net/jpg/06/02/65/95/360_F_602659570_K7lQl8Z5VpbObxwYunvoIgFX8Hv4pqlp.jpg"
                            alt="">
                        <p class="text-center text-xl text-slate-600 font-bold m-2">Cart is Empty !! No Product Found</p>
                    </div>
                @endforelse

            </div>


            {{-- Other Side Payment and Coupon --}}
            <div class="w-1/3 rounded-xl  m-2 h-auto flex flex-col gap-2">

                @foreach ($sale as $item)
                    <div class="p-2 rounded-xl bg-slate-100">
                        <h1 class="text-xl font-bold text-black">{{ $item->name }}</h1>
                        <h2 class="text-slate-500 font-semibold">Total Discout : {{ $item->offer }}</h2>
                        <p class="font-slate-500">{!! $item->description !!}</p>
                        <img class="h-48 object-cover w-full rounded-xl mt-2 mb-2"
                            src="{{ asset('storage/' . $item->image) }}" alt="">
                    </div>
                @endforeach

                {{-- <div class="p-2 rounded-xl bg-slate-100">
                    <h1 class="text-xl font-bold text-black">Sale Information</h1>
                    <p class="text-slate-500">Hey, This is the Black Friday and our 90% sale is going on, please buy as much
                        as you can.</p>
                    <img class="h-48 object-cover w-full rounded-xl mt-2 mb-2"
                        src="https://images.pexels.com/photos/5650052/pexels-photo-5650052.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        alt="">
                </div> --}}

                <div class="p-2 rounded-xl bg-slate-100">
                    <h1 class="text-xl font-bold text-black mb-5">Order Summery</h1>
                    <div class="flex justify-between">
                        <p class="text-slate-500 font-semibold">Bag Total</p>
                        <p class="text-slate-900 font-semibold">@php
                            echo '₹' . $totalPrice . '.00';
                        @endphp</p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-slate-500 font-semibold">Bag Discount <span
                                class="text-yellow-500 font-semibold">(10%)</span>
                        </p>
                        <p class="text-slate-900 font-semibold">@php

                            $discountedPrice = floor($totalPrice) / 10;
                            echo '₹' . floor($discountedPrice) . '.00';

                        @endphp</p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-slate-500 font-semibold">Delivery Fee</p>
                        <p class="text-slate-900 font-semibold">₹00.00</p>
                    </div>
                    <div class="flex justify-between mt-5">
                        <p class="text-yellow-500 text-xl font-bold">Grand Total</p>
                        {{-- This is the Grand Total  --}}
                        <p class="text-yellow-500 text-xl font-bold">@php
                            $grandTotalPrice = floor($totalPrice) - $discountedPrice;
                            echo '₹' . floor($grandTotalPrice);
                        @endphp</p>
                    </div>
                </div>

                <div class="p-2 rounded-xl bg-yellow-400">
                    <h1 class="text-xl font-bold text-black">Payment Mode</h1>
                    <p class="text-slate-500">Please select your convenient Payment mode.</p>

                    <form action="{{ url('/paymentType') }}" method="get">
                        <select name="payment_type" class="bg-slate-200 mt-5 p-2 w-full rounded-xl">
                            <option value="online">Online</option>
                            <option value="cod">Cash On Delivery</option>
                        </select>
                        <input type="submit" class="bg-black w-full mt-2 p-2 text-white font-semibold rounded-xl"
                            value="Checkout">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
