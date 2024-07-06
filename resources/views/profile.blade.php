@extends('Layout.app')
@push('title')
    <title>Profile</title>
@endpush

@section('body')
    <div class="p-2 mt-10 mb-10">

        <div class="mt-5 flex justify-center bg-slate-100 rounded-xl p-2 flex-col items-center">
            <img class="h-64 w-64 object-cover rounded-full mb-2 border-4 border-red-500 hover:border-0 hover:transition-all"
                src="{{ asset('storage/' . $profile->profilePic) }}">
            <p class="font-bold">{{ $profile->name }}</p>
            <p>{{ $profile->email }}</p>
            <p>Phone: {{ $profile->phone }}</p>
            {{-- {{$profile->id}} --}}
            <div class="mt-2 flex gap-2">

                <a href="{{ url('/profile/edit/' . $profile->id) }}"
                    class="bg-yellow-500 text-white font-medium p-2 rounded-xl">Edit
                    Profile</a>

                <form action="{{ url('/profile/delete/' . $profile->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" class="bg-red-500 text-white cursor-pointer font-medium p-2 rounded-xl"
                        value="Delete Profile">
                </form>
            </div>
        </div>


        <div class="mt-5">
            <div class="flex items-center justify-between">
                <h1 class="font-bold text-xl">Saved Address</h1>
                <button type="button" data-modal-target="default-modal" data-modal-toggle="default-modal"
                    class="text-yellow-500 font-bold"><i class="fa-solid fa-pencil"></i> Add New Address</button>
            </div>

            @forelse ($profile->address as $value)
                <div class="bg-slate-100 rounded-xl p-2 mt-2">
                    <p class="text-yellow-500 font-bold text-xl"> {{ $value->name }}</p>
                    <p class="font-medium">Locality : {{ $value->locality }}</p>
                    <p class="font-medium">City : {{ $value->city }}</p>
                    <p class="font-medium">State : {{ $value->state }}</p>
                    <p class="font-medium">Country : {{ $value->country }}</p>
                    <p class="font-medium">Pincode : {{ $value->pincode }}</p>
                    <p class="font-medium"> Phone : {{ $value->phone }}</p>
                    <div class="flex gap-2 mt-2">
                        <a class="text-sm bg-black text-yellow-500 font-medium p-1 rounded-lg"
                            href="/edit/address/form">Edit Address</a>

                        <form action="{{ url('/delete/address/' . $value->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit"
                                class="text-sm cursor-pointer bg-red-500 text-white font-medium p-1 rounded-lg"
                                value="Delete Address">
                        </form>
                    </div>
                </div>
            @empty
                <p class="font-semibold text-slate-500">No Saved Address Found!!</p>
            @endforelse

            {{-- Model HTML Code  --}}

            <!-- Main modal -->
            <div id="default-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Add new Address
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="default-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close model</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 space-y-4">
                            <form action="{{ url('/store/address') }}" method="post" class="flex flex-col">
                                @csrf
                                <label for="name">Name</label>
                                <input type="text"
                                    class="bg-slate-100 p-2 rounded-xl @error('name') border border-red-500 @enderror"name="name"
                                    placeholder="Name" value="{{ old('name') }}">
                                @error('name')
                                    <p class="text-red-500 mb-2">{{ $message }}</p>
                                @enderror
                                <label for="phone">Phone</label>
                                <input
                                    type="number"class="bg-slate-100 p-2 rounded-xl @error('phone') border border-red-500 @enderror"
                                    name="phone" placeholder="Phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <p class="text-red-500 mb-2">{{ $message }}</p>
                                @enderror
                                <label for="locality">Locality</label>
                                <input
                                    type="text"class="bg-slate-100 p-2 rounded-xl @error('locality') border border-red-500 @enderror"
                                    name="locality" placeholder="Locality" value="{{ old('locality') }}">
                                @error('locality')
                                    <p class="text-red-500 mb-2">{{ $message }}</p>
                                @enderror
                                <label for="city">City</label>
                                <input
                                    type="text"class="bg-slate-100 p-2 rounded-xl @error('city') border border-red-500 @enderror"
                                    name="city" placeholder="City" value="{{ old('city') }}">
                                @error('city')
                                    <p class="text-red-500 mb-2">{{ $message }}</p>
                                @enderror
                                <label for="state">State</label>
                                <input type="text"
                                    class="bg-slate-100 p-2 rounded-xl @error('state') border border-red-500 @enderror"name="state"
                                    placeholder="State" value="{{ old('state') }}">
                                @error('state')
                                    <p class="text-red-500 mb-2">{{ $message }}</p>
                                @enderror
                                <label for="country">Country</label>
                                <input
                                    type="text"class="bg-slate-100 p-2 rounded-xl @error('country') border border-red-500 @enderror"
                                    name="country" placeholder="Country" value="{{ old('country') }}">
                                @error('country')
                                    <p class="text-red-500 mb-2">{{ $message }}</p>
                                @enderror
                                <label for="pincode">Pincode</label>
                                <input type="number"
                                    class="bg-slate-100 p-2 rounded-xl @error('pincode') border border-red-500 @enderror"
                                    name="pincode" placeholder="Pincode" value="{{ old('pincode') }}">
                                @error('pincode')
                                    <p class="text-red-500 mb-2">{{ $message }}</p>
                                @enderror
                                <input type="submit" class="p-2 bg-blue-500 mt-2 text-white font-semibold rounded-xl"
                                    value="Add Address">
                            </form>

                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button data-modal-hide="default-modal" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Order List   --}}
        <div class="mt-5">
            <h1 class="font-bold text-xl">Orders</h1>
            @forelse ($profile->orders as $value)
                <div class="bg-slate-100 rounded-xl p-2 mt-2">
                    <p>Total Amount : {{ $value->total_amount }}</p>
                    <p>Payment Mode : {{ $value->payment_mode }}</p>
                    <p>Order Status : {{ $value->order_status }}</p>
                    <p> Payment Status : {{ $value->payment_status }}</p>
                    @php
                        $OrderDate = substr($value->created_at, 0, 10);
                    @endphp
                    <p>Order Date : {{ get_format_date($OrderDate, 'd-M-Y') }}</p>

                    <div class="flex gap-2 mt-2">
                        <a class="text-sm bg-black text-yellow-500 font-medium p-1 rounded-lg"
                            href="/edit/address/form">Edit Order</a>

                        <form action="{{ url('/order/cancel/' . $value->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit"
                                class="text-sm cursor-pointer bg-red-500 text-white font-medium p-1 rounded-lg"
                                value="Cancel Order">
                        </form>
                    </div>
                </div>
            @empty
                <p class="font-semibold text-slate-500">No Orders Found!!</p>
            @endforelse
        </div>
    </div>

    <script>
        console.log("Hello World");
    </script>
@endsection
