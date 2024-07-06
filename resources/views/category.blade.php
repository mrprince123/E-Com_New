@extends('Layout.app')
@push('title')
    <title>Category</title>
@endpush

@section('body')

{{-- Adding the External Script  --}}
<script type="text/javascript" src="{{ asset('js/wishlist.js') }}"></script>



    @if (session('message'))
        <p id="message_data" class="text-center mt-5 mb-5 text-red-500 font-semibold p-2 m-2 rounded-xl bg-red-100">
            {{ session('message') }}
        </p>
    @endif

    @forelse ($category as $data)
        <div class="p-2 m-2">
            @php
                $name = ucwords($data->name);
                echo " <h2 class='font-bold text-3xl text-yellow-500 mt-4'>$name</h2>";
            @endphp
            <div class="w-full m-auto grid grid-cols-4 gap-2">
                @forelse ($data->products as $item)
                    <div class="w-full m-2 p-3 bg-slate-100 rounded-xl">
                        <img src="{{ asset('storage/' . $item->product_pic) }}"
                            class="rounded-xl h-64 mb-2 object-cover w-full" alt="">

                        <div class="flex justify-between">
                            <div>
                                <p class="font-semibold"> {{ $item->name }}</p>
                                <p class="text-yellow-500 font-bold"> ₹{{ $item->price }}/-</p>
                            </div>
                            {{-- Add to Wishlist  --}}
                            <div class="rounded-xl">
                                <form action="{{ route('wishlist.add') }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <input type="text" name="user_id" hidden value="{{ Auth::id() }}">
                                    <input type="text" name="product_id" hidden value="{{ $item->id }}">
                                    <button type="submit">
                                        <i
                                            class="fa-solid fa-heart text-xl text-white bg-yellow-300 hover:bg-yellow-500 p-2 rounded-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- Here only show the 20 words Do implement the logic --}}
                        @php
                            $shortDesc = substr($item->description, 0, 100);
                        @endphp
                        <p class="text-slate-500 mb-auto">{{ $shortDesc }}...</p>
                        <div class="flex gap-2 mt-2">

                            {{-- For Add To Cart Button  --}}
                            <form action="{{ url('/add/cart/' . $item->id) }}" class="w-1/2" method="post">
                                @csrf
                                @method('POST')
                                <input type="number" hidden name="user_id" value="{{ Auth::id() }}">
                                <input type="number" hidden name="product_id" value="{{ $item->id }}">
                                <input type="number" hidden name="quantity" value="{{ $quantity = 1 }}">
                                <input type="submit"
                                    class="w-full cursor-pointer bg-yellow-500 text-black font-semibold p-2 rounded-xl"
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

    @empty
        <div class="w-1/2 m-auto mt-10 mb-10 flex items-center justify-center flex-col">
            <img class="h-96 w-1/2 m-auto object-cover"
                src="https://img.freepik.com/free-vector/oops-404-error-with-broken-robot-concept-illustration_114360-5529.jpg?t=st=1714565013~exp=1714568613~hmac=351d661203a59b9fc00a0efff1591faaad7f213bca9787e8605eb1307c852bca&w=740"
                alt="">
            <h1 class="text-slate-600 text-center font-bold text-2xl">No Product Found!!</h1>
            <p class="text-slate-600 text-center font-medium">Really Sorry, We are working on it have patience, We will add
                product
                soon.</p>
            <p class="text-slate-600 text-center font-medium">Thanks for Understanding</p>
            <a href="{{ url('/') }}" class="bg-black text-yellow-500 font-semibold p-2 m-2 rounded-xl">Back Home</a>
        </div>
    @endforelse


    {{-- <script>
        const message = document.getElementById('message_data');
        console.log(message);
        setTimeout(() => {
            message.style.display = 'none';
        }, 3000);
    </script> --}}
@endsection
