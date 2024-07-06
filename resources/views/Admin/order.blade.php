@extends('Admin.admin')
@push('title')
    <title>Orders</title>
@endpush

@section('main-content')
    <div class="m-2 p-2 bg-slate-100 rounded-xl">



        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>

                        <th scope="col" class="px-6 py-3">
                            Id
                        </th>
                        <th scope="col" class="px-6 py-3">
                            User ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Address ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total Amount
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Payment Mode
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Order Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Payment Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $item)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $item->user_id }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->address_id }}
                            </td>
                            <td class="px-6 py-4 w-1/6">

                                {{ $item->total_amount }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->payment_mode }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $item->order_status }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $item->payment_status }}
                            </td>

                            <td class="px-6 py-4 flex flex-col gap-2">

                                <a class="bg-blue-500 text-white text-center p-2 rounded-xl font-semibold"
                                    href="{{ url('/edit/order/' . $item->id) }}">Edit</a>

                                <form action="{{ url('/delete/orderItem/' . $item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input class="bg-red-500 text-white p-2 rounded-xl font-semibold w-full" type="submit"
                                        value="Delete">
                                </form>

                            </td>
                        </tr>

                    @empty
                        <p class="p-2 m-2 font-semibold">No Product Data Found!!!</p>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
