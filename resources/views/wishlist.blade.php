@extends('Layout.app')
@push('title')
    <title>WishList</title>
@endpush

@section('body')
    {{-- Adding the External Script  --}}
    <script type="text/javascript" src="{{ asset('js/wishlist.js') }}"></script>

    @if (session('message'))
        <p id="message_data" class="text-center mt-5 mb-5 text-red-500 font-semibold p-2 m-2 rounded-xl bg-red-100">
            {{ session('message') }}
        </p>
    @endif

    <h1 class="font-bold text-2xl mt-10 text-gray-700">WishList</h1>
    <div class="p-2 m-2 grid grid-cols-4 gap-2">

        @forelse ($wishlist as $data)
            {{-- Now Query all the Product Behalf of the Product_id --}}
            @php
                $product = App\Models\Product::find($data->product_id);
            @endphp
            @if ($product)
                <div class="w-full m-2 p-3 bg-slate-100 rounded-xl">
                    <img src="{{ asset('storage/' . $product->product_pic) }}"
                        class="rounded-xl h-64 mb-2 object-cover w-full" alt="">

                    <div class="flex justify-between">
                        <div>
                            <p class="font-semibold"> {{ $product->name }}</p>
                            <p class="text-yellow-500 font-bold"> ₹{{ $product->price }}/-</p>
                        </div>
                        {{-- Remove Product from Wishlist  --}}
                        <div class="rounded-xl" title="Remove product from wishlist">
                            <form action="{{ url('/wishlist/delete/' . $data->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="text" name="user_id" hidden value="{{ Auth::id() }}">
                                <input type="text" name="product_id" hidden value="{{ $product->id }}">
                                <button type="submit">
                                    <i
                                        class="fa-solid fa-xmark text-xl text-white bg-red-300 p-2 rounded-lg hover:bg-red-500"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Here only show the 20 words Do implement the logic --}}
                    @php
                        $shortDesc = substr($product->description, 0, 100);
                    @endphp
                    <p class="text-slate-500 mb-auto">{{ $shortDesc }}...</p>
                    <div class="flex gap-2 mt-2">
                        {{-- For Add To Cart Button  --}}
                        <form action="{{ url('/add/cart/' . $product->id) }}" class="w-1/2" method="post">
                            @csrf
                            @method('POST')
                            <input type="number" hidden name="user_id" value="{{ Auth::id() }}">
                            <input type="number" hidden name="product_id" value="{{ $product->id }}">
                            <input type="number" hidden name="quantity" value="{{ $quantity = 1 }}">
                            <input type="submit"
                                class="w-full cursor-pointer bg-yellow-500 text-black font-semibold p-2 rounded-xl"
                                value="Add To Cart">
                        </form>
                        <button class="w-1/2 bg-black text-yellow-500 font-semibold p-2 rounded-xl"><a
                                href="{{ url('/show/product/' . $product->id) }}">See full Details</a></button>
                    </div>
                </div>
            @else
                <p>No Product Found in Wishlist</p>
            @endif

        @empty
            <div class="m-auto mt-10 mb-10 flex products-center w-full justify-center items-center flex-col">
                <img class="h-96 w-1/2 m-auto object-cover"
                    src="https://img.freepik.com/free-vector/no-data-concept-illustration_114360-2506.jpg?t=st=1718189564~exp=1718193164~hmac=6e52301e29ddcab07d130088e1b48241106d355f4f7e55d41414c93ba058c6ee&w=740"
                    alt="">
                <h1 class="text-slate-600 text-center font-bold mt-5 text-2xl">No Product Found in your WishList!!</h1>
                <p class="text-slate-600 text-center font-medium mt-2">Please add product to your wishlist.</p>
                <p class="text-slate-600 text-center font-medium">Thanks for Understanding</p>
                <a href="{{ url('/') }}"
                    class="bg-black text-yellow-500 text-center font-semibold p-2 m-2 rounded-xl">Back
                    Home</a>
            </div>
        @endforelse
    </div>
@endsection
