@extends('Layout.app')
@push('title')
    <title>Category Products</title>
@endpush

@section('body')
    <div class="mt-10 mb-10">

        {{-- Show Product of Only One Category --}}

        @php
            $categoryName = ucwords($category->name);
        @endphp
        <h2 class="text-2xl mb-5 font-bold text-black">{{ $categoryName }}</h2>

        <div class="w-full m-auto grid grid-cols-4 gap-2">
            @forelse ($products as $item)
                <div class="w-full m-2 p-2 bg-slate-100 rounded-xl">

                    <img src="{{ asset('storage/' . $item->product_pic) }}" class="rounded-xl h-64 object-cover w-full"
                        alt="Product Image">
                    <p class="font-semibold"> {{ $item->name }}</p>

                    <p class="text-yellow-500 font-bold"> ₹{{ $item->price }}/-</p>
                    <p class="text-slate-500 mb-auto">{{ $item->description }}</p>
                    <div class="flex gap-2 mt-2">

                        {{-- For Add To Cart Button  --}}
                        <form action="{{ url('/add/cart/' . $item->id) }}" class="w-1/2" method="post">
                            @csrf
                            @method('POST')
                            <input type="number" hidden name="user_id" value="{{ Auth::id() }}">
                            <input type="number" hidden name="product_id" value="{{ $item->id }}">
                            <input type="number" hidden name="quantity" value="{{ $quantity = 1 }}">
                            <input type="submit"
                                class="w-full bg-yellow-500 cursor-pointer text-black font-semibold p-2 rounded-xl"
                                value="Add To Cart">
                        </form>
                        <button class="w-1/2 bg-black text-yellow-500 font-semibold p-2 rounded-xl"><a
                                href="{{ url('/show/product/' . $item->id) }}">See full Details</a></button>
                    </div>

                </div>

            @empty
                <p>No Product is Found!!</p>
            @endforelse
        </div>

    </div>
@endsection
