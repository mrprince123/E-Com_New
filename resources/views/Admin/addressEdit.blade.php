@extends('Admin.admin')
@push('title')
    <title>User Address Update </title>
@endpush

@section('main-content')
    <div class="mt-10 mb-10 p-2 bg-slate-100 shadow-xl rounded-xl w-1/2 m-auto">

        <form action="{{ url('/update/address/' . $address->id) }}" method="post" enctype="multipart/form-data"
            class="flex flex-col gap-2 ">
            @csrf
            @method('PUT')

            <h2 class="text-center text-xl text-purple-500 font-semibold">Address Update</h2>
            <label for="name" class="font-semibold">Name</label>
            <input type="text" name="name" value="{{ $address->name }}" class="p-2 rounded-xl bg-white">
            <label for="Phone" class="font-semibold">Phone</label>
            <input type="number" name="phone" value="{{ $address->phone }}" class="p-2 rounded-xl bg-white">
            <label for="locality" class="font-semibold">Locality</label>
            <input type="text" name="locality" value="{{ $address->locality }}" class="p-2 rounded-xl bg-white">

            <label for="city" class="font-semibold">City</label>
            <input type="text" name="city" value="{{ $address->city }}" class="p-2 rounded-xl bg-white">

            <label for="state" class="font-semibold">State</label>
            <input type="text" name="state" value="{{ $address->state }}" class="p-2 rounded-xl bg-white">

            <label for="country" class="font-semibold">Country</label>
            <input type="text" name="country" value="{{ $address->country }}" class="p-2 rounded-xl bg-white">

            <label for="pincode" class="font-semibold">Pincode</label>
            <input type="text" name="pincode" value="{{ $address->pincode }}" class="p-2 rounded-xl bg-white">


            <input value="Update address Data" type="submit" class="p-2 rounded-xl bg-purple-500 text-white">
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
