@extends('Admin.admin')
@push('title')
    <title>Product Update</title>
@endpush

@section('main-content')
    <div class="mt-10 mb-10 p-2 bg-slate-400 rounded-xl w-1/2 m-auto">

        <form action="{{ url('/update/product/' . $product->id) }}" method="post" enctype="multipart/form-data"
            class="flex flex-col gap-2">
            @csrf
            @method('PUT')
            <label for="name" class="font-semibold">Category</label>
            <select name="category_id" class="p-2 rounded-xl bg-slate-100">
                @forelse ($category as $item)
                    @php
                        $categoryName = ucfirst($item->name);
                    @endphp
                    <option value="{{ $item->id }}">{{ $categoryName }}</option>
                @empty
                    <p>No Category Found</p>
                @endforelse
            </select>


            <label for="name" class="font-semibold">Name</label>
            <input type="text" name="name" value="{{ $product->name }}" class="p-2 rounded-xl bg-slate-100">
            <label for="description" class="font-semibold">Description</label>
            <input type="text" name="description" value="{{ $product->description }}"
                class="p-2 rounded-xl bg-slate-100">
            <label for="price" class="font-semibold">Price </label>
            <input type="text" name="price" value="{{ $product->price }}" class="p-2 rounded-xl bg-slate-100">

            <label for="product_pic" class="font-semibold">Product Image</label>
            <img id="myimage" src="{{ asset('storage/' . $product->product_pic) }}" alt="Product Images"
                class="p-2 rounded-xl bg-slate-100 h-96 object-cover w-full">
            <input onchange="onFileSelected(event)" type="file" name="product_pic" class="p-2 rounded-xl bg-slate-100">

            <label for="detail_description" class="font-semibold">Detail Description</label>
            <div class="m-2">
                <textarea name="detail_description" id="input_editor" class="rounded-lg h-80 border-2 p-2 m-2 h-96" cols="30"
                    rows="10" placeholder="Details Description">{{ $product->detail_description }}</textarea>
            </div>

            <input value="Update Product Data" type="submit" class="p-2 rounded-xl bg-purple-500 text-white">
        </form>

    </div>


    <script>
        // This is for the Ck Editor 
        ClassicEditor
            .create(document.querySelector('#input_editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.log(error);
            });



        // This is for showing the live photo selected by the user. 
        function onFileSelected(event) {
            var selectedFile = event.target.files[0];
            var reader = new FileReader();

            var imgtag = document.getElementById("myimage");
            imgtag.title = selectedFile.name;

            reader.onload = function(event) {
                imgtag.src = event.target.result;
            };

            reader.readAsDataURL(selectedFile);
        }
    </script>
@endsection
