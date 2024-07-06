@extends('Admin.admin')
@push('title')
    <title>Category Edit Update</title>
@endpush

@section('main-content')
    <div class="mt-10 mb-10 p-2 bg-slate-400 rounded-xl w-1/2 m-auto">

        <form action="{{ url('/update/category/' . $category->id) }}" method="post" enctype="multipart/form-data"
            class="flex flex-col gap-2">
            @csrf
            @method('PUT')


            <label for="name" class="font-semibold">Name</label>
            <input type="text" readonly name="name" value="{{ $category->name }}" class="p-2 rounded-xl bg-slate-100">

            <select name="name" class="p-2 rounded-xl bg-slate-100">
                <option value="electronics">Electronic</option>
                <option value="groceries">Groceries</option>
                <option value="books">Books</option>
                <option value="fashion">Fashion</option>
                <option value="food">Food</option>
                <option value="sports">Sports</option>
                <option value="stationary">Stationary</option>
                <option value="furniture">Furniture</option>
                <option value="cosmetics">Cosmetics</option>
                <option value="healths">Healths</option>
                <option value="games">Games</option>
                <option value="others">Others</option>

            </select>

            <label for="categoryImg" class="font-semibold">category Image</label>
            <img id="myimage" src="{{ asset('storage/' . $category->categoryImg) }}" alt="category Images"
                class="p-2 rounded-xl bg-slate-100 h-96 object-cover w-full">
            <input onchange="onFileSelected(event)" type="file" name="categoryImg" class="p-2 rounded-xl bg-slate-100">

            <label for="description" class="font-semibold">Detail Description</label>
            <div class="m-2">
                <textarea name="description" id="input_editor" class="rounded-lg h-80 border-2 p-2 m-2 h-96" cols="30"
                    rows="10" placeholder="Description">{{ $category->description }}</textarea>
            </div>

            <input value="Update category Data" type="submit" class="p-2 rounded-xl bg-purple-500 text-white">
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
