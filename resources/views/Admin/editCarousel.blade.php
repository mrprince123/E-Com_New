@extends('Admin.admin')
@push('title')
    <title>Carousel Edit</title>
@endpush

@section('main-content')
    <div class="mt-10 mb-10 p-2 bg-slate-400 rounded-xl w-1/2 m-auto">

        <form action="{{ url('/update/carousel/' . $carousel->id) }}" method="post" enctype="multipart/form-data"
            class="flex flex-col gap-2">
            @csrf
            @method('PUT')

            <label for="image" class="font-semibold">Carousel Image</label>
            <img id="myimage" src="{{ asset('storage/' . $carousel->image) }}" alt="sale Images"
                class="p-2 rounded-xl bg-slate-100 h-96 object-cover w-full">
            <input onchange="onFileSelected(event)" type="file" name="image" class="p-2 rounded-xl bg-slate-100">


            <label for="caption" class="font-semibold">Caption</label>
            <input type="text" name="caption" value="{{ $carousel->caption }}" class="p-2 rounded-xl bg-slate-100">

            <input value="Update Carousel Data" type="submit" class="p-2 rounded-xl bg-purple-500 text-white">
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
