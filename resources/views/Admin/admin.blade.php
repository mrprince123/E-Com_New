<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @stack('title')
    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- CK Editor CDN  --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>

</head>

<body class="flex h-screen">

    <div class="sidebar w-1/6 bg-slate-800 flex text-white gap-2 flex-col p-2 m-2 rounded-xl justify-between">

        <div class="flex flex-col">

            <a href="/admin" class="">
                <h2 class="font-bold p-2 m-1 text-xl"><i class="text-purple-500">ECOM</i>EXPRESS</h2>
            </a>
            <a href="/admin"
                class=" text-slate-200 font-normal text-xl rounded-xl p-2 m-1 hover:bg-slate-400 hover:text-white hover:rounded-xl"><i
                    class="fa-solid fa-house-user p-2 text-purple-500"></i>Home</a>
            <a href="/admin/user"
                class=" text-slate-200 font-normal text-xl rounded-xl p-2 m-1 hover:bg-slate-400 hover:text-white hover:rounded-xl"><i
                    class="fa-solid fa-users p-2 text-purple-500"></i>User</a>
            <a href="/admin/cart"
                class=" text-slate-200 font-normal text-xl rounded-xl p-2 m-1 hover:bg-slate-400 hover:text-white hover:rounded-xl"><i
                    class="fa-solid fa-cart-plus p-2 text-purple-500"></i>Cart</a>
            <a href="/admin/order"
                class=" text-slate-200 font-normal text-xl rounded-xl p-2 m-1 hover:bg-slate-400 hover:text-white hover:rounded-xl"><i
                    class="fa-solid fa-square-poll-vertical p-2 text-purple-500"></i>Order</a>
            <a href="/admin/product"
                class=" text-slate-200 font-normal text-xl rounded-xl p-2 m-1 hover:bg-slate-400 hover:text-white hover:rounded-xl"><i
                    class="fa-solid fa-bag-shopping p-2 text-purple-500"></i>Product</a>
            <a href="/admin/address"
                class=" text-slate-200 font-normal text-xl rounded-xl p-2 m-1 hover:bg-slate-400 hover:text-white hover:rounded-xl"><i
                    class="fa-regular fa-address-book p-2 text-purple-500"></i>Address</a>
            <a href="{{ url('/admin/category') }}"
                class=" text-slate-200 font-normal text-xl rounded-xl p-2 m-1 hover:bg-slate-400 hover:text-white hover:rounded-xl">
                <i class="fa-solid fa-list p-2 text-purple-500"></i>Category</a>

            <a href="{{ url('/admin/sale') }}"
                class="text-slate-200 font-normal text-xl rounded-xl p-2 m-1 hover:bg-slate-400 hover:text-white hover:rounded-xl">
                <i class="fa-solid fa-hand-holding-dollar p-2 text-purple-500"></i>Sale</a>

                <a href="{{ url('/admin/wishlist') }}"
                class="text-slate-200 font-normal text-xl rounded-xl p-2 m-1 hover:bg-slate-400 hover:text-white hover:rounded-xl">
                <i class="fa-solid fa-heart p-2 text-purple-500"></i>Wishlist</a>


            <a href="{{ url('/admin/carousel') }}"
                class="text-slate-200 font-normal text-xl rounded-xl p-2 m-1 hover:bg-slate-400 hover:text-white hover:rounded-xl">
                <i class="fa-solid fa-images p-2 text-purple-500"></i>Carousel</a>


        </div>

        <a href="{{ route('admin.logout') }}"
            class=" text-slate-200 font-normal text-xl rounded-xl p-2 m-1 hover:bg-slate-400 hover:text-white hover:rounded-xl"><i
                class="fa-solid fa-arrow-right-from-bracket p-2 text-purple-500" title="Logout"></i> Logout</a>

    </div>
    <div class="w-5/6">

        <div class="m-2 p-3 bg-slate-800 text-white rounded-xl flex justify-between items-center">
            <h2 class="font-semibold text-lg"><i class="fa-solid fa-screwdriver-wrench text-purple-500"></i> Admin
                Dashboard
            </h2>

            <a href=""><img class="h-10 w-10 rounded-full object-cover"
                    src="https://imgv3.fotor.com/images/slider-image/A-clear-close-up-photo-of-a-woman.jpg"
                    alt=""></a>
        </div>

        <div class="main-content">
            @yield('main-content')
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>

</body>

</html>
