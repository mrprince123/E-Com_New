@extends('Layout.app')
@push('title')
    <title>Detail Product</title>
@endpush

@section('body')
    {{-- Adding the External Script  --}}
    <script type="text/javascript" src="{{ asset('js/wishlist.js') }}"></script>


    @if (session('message'))
        <p id="message_data" class="text-center mt-5 mb-5 text-red-500 font-semibold p-2 m-2 rounded-xl bg-red-100">
            {{ session('message') }}
        </p>
    @endif

    <div class="flex gap-2 mt-10 mb-10">
        <div class="w-1/2 p-2 flex flex-col items-center">

            <div class="image_container">
                <img id="product_images" class="w-full rounded-xl h-96 object-contain"
                    src="{{ asset('storage/' . $product->product_pic) }}" alt="Product Images">
            </div>

            {{-- For Add To Cart Button  --}}
            <div class="flex w-full gap-2 mt-2 items-center">
                <form action="{{ url('/add/cart/' . $product->id) }}" class="w-1/2" method="post">
                    @csrf
                    @method('POST')
                    <input type="number" hidden name="user_id" value="{{ Auth::id() }}">
                    <input type="number" hidden name="product_id" value="{{ $product->id }}">
                    <input type="number" hidden name="quantity" value="{{ $quantity = 1 }}">
                    <input type="submit"
                        class="cursor-pointer w-full bg-yellow-500 text-black font-semibold p-2 rounded-xl"
                        value="Add To Cart">
                </form>

                <a href="{{ url('/category') }}" class="w-1/2"><button
                        class="bg-black w-full text-yellow-500 font-bold p-2 rounded-xl text-center">Go
                        Back</button></a>

                {{-- Add to Wishlist  --}}
                <div class="rounded-xl items-end">
                    <form action="{{ route('wishlist.add') }}" method="post">
                        @csrf
                        @method('POST')
                        <input type="text" name="user_id" hidden value="{{ Auth::id() }}">
                        <input type="text" name="product_id" hidden value="{{ $product->id }}">
                        <button type="submit">
                            <i
                                class="fa-solid fa-heart text-xl text-white bg-yellow-300 hover:bg-yellow-500 p-2 rounded-lg"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>

        <div class="w-1/2 p-2">
            <h2 class="font-semibold text-black text-xl">{{ $product->name }}</h2>
            <p class="text-slate-500 text-justify">{{ $product->description }}</p>
            <p class="text-yellow-500 font-bold text-xl">₹{{ $product->price }}</p>


            <h2 class="font-bold  text-xl mt-5">Details Description</h2>
            <p class="text-justify">{!! $product->detail_description !!}</p>

            {{-- Category Description --}}
            @php
                $category = App\Models\Category::find($product->category_id);
            @endphp

            @if ($category)
                @php
                    $catName = ucfirst($category->name);
                @endphp
                <p class="font-bold text-2xl mt-5 text-yellow-500 mb-2">{{ $catName }}</p>
                <img class="h-64 rounded-xl object-cover" src="{{ asset('storage/' . $category->categoryImg) }}"
                    alt="">
                <p>{!! $category->description !!}</p>
            @endif

        </div>
    </div>



    <style>
        .image_container {
            overflow: hidden;
        }

        .image_container img {
            transition: transform 0.5s ease;
        }

        .image_container:hover img {
            transform: scale(1.3);
            height: 500px;
            width: 100%;
        }
    </style>
@endsection
