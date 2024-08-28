@extends('Layout.app')
@push('title')
    <title>Home</title>
@endpush

@section('body')
    {{-- Adding the External Script  --}}
    <script type="text/javascript" src="{{ asset('js/wishlist.js') }}"></script>


    @if (session('message'))
        <p id="message_data" class="text-center mt-5 mb-5 text-red-500 font-semibold p-2 m-2 rounded-xl bg-red-100">
            {{ session('message') }}
        </p>
    @endif


    {{-- carousel --}}
    <div class="relative w-full mx-auto mb-20 mt-20">
        <!-- Carousel wrapper -->
        <div class="overflow-hidden relative h-[44rem] rounded-lg ">
            <!-- Carousel items -->
            <div id="carouselItems" class="flex transition-transform duration-500 ease-in-out">
                <div class="w-full flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1522273400909-fd1a8f77637e?q=80&w=2012&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="w-full object-cover h-full" alt="Slide 1">
                </div>
                <div class="w-full flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1627384113710-424c9181ebbb?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="block w-full h-full object-cover" alt="Slide 2">
                </div>
                <div class="w-full flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1492470026006-0e12a33eb7fb?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="block w-full h-full object-cover" alt="Slide 3">
                </div>
                <div class="w-full flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1616865609199-abb1465abf5c?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="block w-full h-full object-cover" alt="Slide 3">
                </div>
            </div>
        </div>

        <!-- Controls -->
        <button onclick="prevSlide()"
            class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 dark:bg-gray-800/30 dark:group-hover:bg-gray-800/60">
                <svg aria-hidden="true" class="w-6 h-6 text-white dark:text-gray-800" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </span>
        </button>
        <button onclick="nextSlide()"
            class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 dark:bg-gray-800/30 dark:group-hover:bg-gray-800/60">
                <svg aria-hidden="true" class="w-6 h-6 text-white dark:text-gray-800" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </span>
        </button>
    </div>

    <script>
        let currentIndex = 0;
        const intervalTime = 3000; // Time in milliseconds for each slide (e.g., 3000ms = 3 seconds)

        function showSlide(index) {
            const carouselItems = document.getElementById("carouselItems");
            const totalSlides = carouselItems.children.length;

            if (index >= totalSlides) {
                currentIndex = 0;
            } else if (index < 0) {
                currentIndex = totalSlides - 1;
            } else {
                currentIndex = index;
            }

            carouselItems.style.transform = `translateX(-${currentIndex * 100}%)`;
        }

        function nextSlide() {
            showSlide(currentIndex + 1);
        }

        function prevSlide() {
            showSlide(currentIndex - 1);
        }

        // Automatic slide change
        setInterval(() => {
            nextSlide();
        }, intervalTime);
    </script>

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
