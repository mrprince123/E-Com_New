<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-auto bg-blue-100 flex items-center">

    <div class="flex bg-white items-center shadow-xl m-auto w-2/3 rounded-xl p-4 mt-20 mb-20">
        <img class="h-full w-1/2 object-cover rounded-xl p-2"
            src="https://img.freepik.com/free-vector/login-concept-illustration_114360-4525.jpg?w=740&t=st=1714049677~exp=1714050277~hmac=0cb551e24e80a50b6a9651f9c0438e3fcde3ff12c267248a268fbf7cb9104e75"
            alt="">
        <div class="w-full">
            <h1 class=" font-bold text-xl text-center">Register Now</h1>
            <p class="text-slate-500 text-center">Please start with new Admin account</p>
            <form class="flex flex-col  p-2" action="{{ route('admin.post.register') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <label class="font-semibold mb-2 mt-4" for="name">Name</label>
                <input class="p-4 rounded-xl bg-slate-100 @error('name') border border-red-500 @enderror" type="text"
                    name="name" value="{{ old('name') }}" placeholder="Name">
                @error('name')
                    <p class="text-red-500 text-center">{{ $message }}</p>
                @enderror
                <label class="font-semibold mb-2 mt-4" for="email">Email</label>
                <input class="p-4 rounded-xl bg-slate-100 @error('email') border border-red-500 @enderror"
                    type="email" value="{{ old('email') }}" name="email" placeholder="Email">
                @error('email')
                    <p class="text-red-500 text-center">{{ $message }}</p>
                @enderror
                <label class="font-semibold mb-2 mt-4" for="phone">Phone</label>
                <input class="p-4 rounded-xl bg-slate-100 @error('phone') border border-red-500 @enderror"
                    type="number" value="{{ old('phone') }}" name="phone" placeholder="Phone">
                @error('phone')
                    <p class="text-red-500 text-center">{{ $message }}</p>
                @enderror
                <label class="font-semibold mb-2 mt-4" for="adminProfilePic">Admin Profile Picture</label>
                <input class="p-4 rounded-xl bg-slate-100 @error('adminProfilePic') border border-red-500 @enderror"
                    type="file" value="{{ old('adminProfilePic') }}" name="adminProfilePic" placeholder="Profile Pic">
                @error('adminProfilePic')
                    <p class="text-red-500 text-center">{{ $message }}</p>
                @enderror
                <label class="font-semibold mb-2 mt-4" for="password">Password</label>
                <input class="p-4 rounded-xl bg-slate-100 @error('password') border border-red-500 @enderror"
                    type="password" name="password" placeholder="Password">
                @error('password')
                    <p class="text-red-500 text-center">{{ $message }}</p>
                @enderror
                <input class="p-4 bg-yellow-500 font-white text-white font-bold rounded-xl mt-2" type="submit"
                    value="Admin Register">
            </form>
            <p class="font-bold text-black text-center">or</p>
            <p class="text-center text-slate-500">Already have an admin account ? <a class="text-yellow-500 font-bold"
                    href="{{ route('admin.login') }}">Signin</a></p>
        </div>

    </div>


</body>

</html>
