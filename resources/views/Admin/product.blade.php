@extends('Admin.admin')
@push('title')
    <title>Product</title>
@endpush

@section('main-content')
    <div class="flex justify-end m-2 p-2">
        <!-- Modal toggle -->
        <button data-modal-target="default-modal" data-modal-toggle="default-modal"
            class="block text-white bg-purple-500 hover:bg-purple-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
            <i class="fa-regular fa-pen-to-square"></i> Add New Product
        </button>
    </div>

    <div class="m-2 p-2 bg-slate-100 rounded-xl">

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>

                        <th scope="col" class="px-6 py-3">
                            Id
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Product Picture
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $item)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $item->category_id }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->name }}
                            </td>
                            <td class="px-6 py-4 w-1/6">

                                {!! $item->description !!}
                            </td>
                            <td class="px-6 py-4">
                                {{ '₹' . $item->price }}
                            </td>
                            <td class="px-6 py-4">
                                <img src="{{ asset('storage/' . $item->product_pic) }}" alt="Product Image"
                                    class="w-64 h-40 object-cover rounded-xl">
                            </td>

                            <td class="px-6 py-4 flex flex-col gap-2">
                                <a class="bg-blue-500 text-white text-center p-2 rounded-xl font-semibold cursor-pointer"
                                    href="{{ url('/edit/product/' . $item->id) }}">Edit</a>





                                <form action="{{ url('/delete/product/' . $item->id) }}" method="post"
                                    class="cursor-pointer">
                                    @csrf
                                    @method('DELETE')
                                    <input class="bg-red-500 text-white p-2 w-full rounded-xl font-semibold" type="submit"
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

        <!-- Main modal -->
        <div id="default-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Add New Product
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="default-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">

                        <form action="{{ url('/store/product') }}" method="post" class="flex flex-col gap-2"
                            enctype="multipart/form-data">
                            @csrf
                            <label for="name" class="font-semibold">Name</label>
                            <input type="text" name="name" placeholder="Name" class="p-2 rounded-xl bg-slate-100">
                            <label for="description" class="font-semibold">Description</label>
                            <input type="text" name="description" placeholder="Product Description"
                                class="p-2 rounded-xl bg-slate-100">
                            <label for="price" class="font-semibold">Price</label>
                            <input type="number" name="price" placeholder="Product Price"
                                class="p-2 rounded-xl bg-slate-100">
                            <label for="product_pic" class="font-semibold">Product Picture</label>
                            <input type="file" name="product_pic" placeholder="Product Pic"
                                class="p-2 rounded-xl bg-slate-100">

                            <label for="product_pic" class="font-semibold">Select Category</label>
                            <select name="category_id">
                                @php
                                    $category = App\Models\Category::all();
                                    foreach ($category as $value) {
                                        // echo $value->name;
                                        $catName = ucfirst($value->name);
                                        echo "<option value='$value->id'>$catName</option>";
                                    }
                                @endphp

                            </select>

                            <label for="detail_description" class="font-semibold">Details Description</label>

                            <div class="m-2">
                                <textarea name="detail_description" id="input_editor" class="rounded-lg h-80 border-2 p-2 m-2" cols="30"
                                    rows="10" placeholder="Details Description"></textarea>
                            </div>

                            <input type="submit" value="Add Product"
                                class="p-2 rounded-xl bg-purple-500 text-white font-semibold">

                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#input_editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.log(error);
            });
    </script>
@endsection
