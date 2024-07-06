@extends('Layout.app')
@push('title')
    <title>Product Update</title>
@endpush

@section('body')
    <div class="mt-10 mb-10">

        <h1 class="text-blue-500 font-bold text-xl text-center mb-5">Profile Edit Page</h1>
        <form class="p-2 m-2 rounded-xl flex flex-col shadow-xl" action="{{ url('/profile/update/' . $user->id) }}"
            method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="Name" class="font-semibold mb-2">Name</label>
            <input class="p-2 rounded-lg bg-slate-100 mb-2" type="text" name="name" value="{{ $user->name }}">

            <label for="Name" class="font-semibold mb-2">Email</label>
            <input class="p-2 rounded-lg bg-slate-100 mb-2" type="text" name="email" value="{{ $user->email }}">

            <label for="Name" class="font-semibold mb-2">Phone</label>
            <input class="p-2 rounded-lg bg-slate-100 mb-2" type="text" name="phone" value="{{ $user->phone }}">

            <label for="profilePic" class="font-semibold mb-2">Profile Pic</label>
            <img class="h-96 rounded-xl object-cover mb-2" src="{{ asset('storage/' . $user->profilePic) }}"
                alt="Profile Image">
            <input class="p-2 rounded-lg bg-slate-100 mb-2" name="profilePic" type="file"
                value="{{ $user->profilePic }}">

            <label for="Name" class="font-semibold mb-2">Password</label>
            <input readonly class="p-2 rounded-lg bg-slate-100 mb-2" type="text" name="password"
                value="{{ $user->password }}">

            <label for="Name" class="font-semibold mb-2">Confirm Password</label>
            <input readonly class="p-2 rounded-lg bg-slate-100 mb-2" type="text" name="confirm_password"
                value="{{ $user->confirm_password }}">

            <input type="submit" class="bg-blue-500 text-white font-semibold rounded-xl p-2 cursor-pointer"
                value="Update Profile">
        </form>
    </div>
@endsection
