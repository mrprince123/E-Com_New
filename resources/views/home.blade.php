@extends('Layout.app')
@push('title')
    <title>Home</title>
@endpush

@section('body')
    {{-- Adding the External Script  --}}
    <script type="text/javascript" src="{{ asset('js/wishlist.js') }}"></script>

    {{-- carousel --}}
    @if (session('message'))
        <p id="message_data" class="text-center mt-5 mb-5 text-red-500 font-semibold p-2 m-2 rounded-xl bg-red-100">
            {{ session('message') }}
        </p>
    @endif

    <div id="default-carousel" class="relative w-full mt-10 mb-10" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-72  rounded-xl">

            @forelse ($carousel as $item)
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('storage/' . $item->image) }}"
                        class="absolute block object-cover w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                        alt="...">
                </div>
            @empty
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="https://images.pexels.com/photos/325876/pexels-photo-325876.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="https://images.pexels.com/photos/376464/pexels-photo-376464.jpeg"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="https://images.pexels.com/photos/1024634/pexels-photo-1024634.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 4 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="https://store.storeimages.cdn-apple.com/1/as-images.apple.com/is/iphone-15-pro-model-unselect-gallery-1-202309?wid=5120&hei=2880&fmt=webp&qlt=70&.v=UW1GeTRObi9UaVF4S3FUNERNMWVhZ2FRQXQ2R0JQTk5udUZxTkR3ZVlpSmVJdk5rWHR5c3l5ME9ZNVV1Y1o0SjBoUVhuTWlrY2hIK090ZGZZbk9HeE1xUVVnSHY5eU9CcGxDMkFhalkvT0Q5QmVFZ0s0ZTVTcDJpVVJkaDNNVDdmbW94YnYxc1YvNXZ4emJGL0IxNFp3PT0=&traceId=1"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 5 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="https://images.pexels.com/photos/298863/pexels-photo-298863.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
            @endforelse
        </div>

        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
                data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4"
                data-carousel-slide-to="3"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5"
                data-carousel-slide-to="4"></button>
        </div>

        <!-- Slider controls -->
        <button type="button"
            class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-prev>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4" />
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button"
            class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-next>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>

    {{-- category product  --}}
    <h1 class="text-center text-3xl font-semibold mb-5">Categories</h1>
    <div class="grid grid-cols-5 gap-4 mb-10 mt-10">
        @forelse ($category as $item)
            @if ($item->id <= 16)
                {{-- Open the Seperate Page for Each Category Products  --}}
                <a href="{{ url('/category/one/' . $item->id) }}">

                    <div class="text-center flex flex-col items-center ">
                        <img class="rounded-full w-48 h-48 object-cover mb-3 border-4 border-red-500 hover:border-4 hover:border-yellow-500"
                            src="{{ asset('storage/' . $item->categoryImg) }}" alt="Category Image">
                        @php
                            $name = ucwords($item->name);
                            echo "<h4 class='font-bold text-yellow-500 hover:text-red-500'>$name</h4>";
                        @endphp
                    </div>

                </a>
            @endif
        @empty
            <p>No Category Found!!</p>
        @endforelse
    </div>

    {{-- Here show the Small About  --}}
    <div class="flex w-full bg-pink-100 mt-10 mb-10 rounded-xl">
        <img class="w-1/2  h-[32rem] object-cover rounded-xl" src="images/ecommerce3.jpg" alt="">
        <div class="w-1/2 flex justify-center flex-col gap-4 bg-blue-50 rounded-xl p-4">
            <h2 class="font-bold">ECOM <i class="text-yellow-500 font-bold">EXPRESS</i></h2>
            <h1 class="text-2xl font-bold">Stay Productive, Always Buy Product</h1>
            <p class="font-medium">This is the ECOM Express where you want buy anything, we have all the categories of the
                product you can buy
                anything from here without any worry at cheap and discounted price.</p>
        </div>
    </div>

    {{-- Category Product Data  --}}
    @forelse ($category as $data)
        <div class=" p-2 m-2">
            @php
                $name = ucwords($data->name);
                echo " <h2 class='font-bold text-3xl mb-2'>$name</h2>";
            @endphp
            <div class="w-full m-auto grid grid-cols-4 gap-2">
                @forelse ($data->products as $item)
                    <div class="w-full p-3 m-2 bg-slate-100 rounded-xl">

                        <img src="{{ asset('storage/' . $item->product_pic) }}"
                            class="rounded-xl h-64 object-cover w-full mb-2" alt="">
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
    @empty
        <p>No Category Found !!</p>
    @endforelse

@endsection
