<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @stack('title')

    {{-- Tailwind CDN --}}
    @vite('resources/css/app.css')

    {{-- Font Awesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- CK Editor CDN  --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<body>

    <header class="bg-slate-900 p-4 m-2 rounded-xl text-white font-semibold flex items-center justify-between">
        <h1 class="text-yellow-500 text-xl"><a href="{{ url('/') }}"><i
                    class="text-white text-xl p-2">Ecom</i>Express</a></h1>
        <div class="flex  gap-4 items-center">

            {{-- This is for Showing the Items in Cart  --}}
            @php
                $userId = Auth::id();
                $cart = App\Models\Cart::all()->where('user_id', $userId);
                $cartProductCount = count($cart);
                // echo $cartProductCount;

                $wishlist = App\Models\WishList::all()->where('user_id', $userId);
                $wishListCount = count($wishlist);
            @endphp

            @guest
                <a href="{{ url('/') }}" title="Home" class="text-white hover:text-yellow-500">Home</a>
                <a href="{{ url('/category') }}" title="Product" class="text-white hover:text-yellow-500">Products</a>
                <a href="{{ url('/login') }}"><i
                        class="text-yellow-500 hover:text-white fa-solid fa-arrow-right-to-bracket text-xl"
                        title="Login"></i></a>
            @else
                @php
                    $userData = App\Models\User::find($userId);
                    $userImage = $userData->profilePic;
                    // echo $userImage;
                @endphp

                <a href="{{ url('/') }}" title="Home" class="text-white hover:text-yellow-500">Home</a>
                <a href="{{ url('/category') }}" title="Product" class="text-white hover:text-yellow-500">Products</a>
                <a href="{{ url('/order') }}" title="Product" class="text-white hover:text-yellow-500">Orders</a>

                <button type="button"
                    class="relative inline-flex items-center p-3 text-sm font-medium text-center text-white bg-yellow-500 rounded-lg hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <a href="{{ url('/cart') }}"><i class="fa-solid fa-cart-plus text-xl" title="Cart"></i></a>

                    <div
                        class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">
                        @php
                            echo $cartProductCount;
                        @endphp
                    </div>
                </button>

                <button type="button"
                    class="relative inline-flex items-center p-3 text-sm font-medium text-center text-white bg-yellow-500 rounded-lg hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <a href="{{ url('/wishlist') }}"><i class="fa-solid fa-heart text-xl"></i></a>

                    <div
                        class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">
                        @php
                            echo $wishListCount;
                        @endphp
                    </div>
                </button>

                @php
                    $userId = Auth::id();
                    // echo $userId;
                    // echo "<a href='/profile/$userId'><i class='fa-regular text-xl fa-user hover:text-yellow-500' title='Profile'></i></a>";
                @endphp

                <a href='/profile/@php echo $userId; @endphp'><img
                        class="rounded-full w-10 h-10 border-2 object-cover border-yellow-500"
                        src='{{ asset('storage/' . $userImage) }}' /></a>

                <button class="p-2 rounded-lg text-yellow-500 hover:text-white font-semibold">
                    <a href="{{ url('/logout') }}"><i class="fa-solid fa-arrow-right-from-bracket text-xl"
                            title="Logout"></i></a>
                </button>

            @endguest
        </div>
    </header>
