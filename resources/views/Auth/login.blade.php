<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen bg-blue-100 flex items-center">

    <div class="flex bg-white items-center shadow-xl m-auto w-2/3 rounded-xl p-4">
        <img class="h-full w-1/2 object-cover rounded-xl p-2"
            src="https://img.freepik.com/free-vector/login-concept-illustration_114360-4525.jpg?w=740&t=st=1714049677~exp=1714050277~hmac=0cb551e24e80a50b6a9651f9c0438e3fcde3ff12c267248a268fbf7cb9104e75"
            alt="">
        <div class="w-full">
            <h1 class="font-bold text-xl text-center">Welcome Back</h1>
            <p class="text-slate-500 text-center">Please login to your account</p>

            @if (session('message'))
                <div class="text-center m-2 text-red-500 font-bold bg-red-100 rounded-xl p-2">{{ session('message') }}
                </div>
            @endif

            <form class="flex flex-col  p-2" action="{{ url('/user/login') }}" method="post">
                @csrf
                <label class="font-semibold mb-2 mt-4" for="email">Email</label>
                <input class="p-4 rounded-xl @error('email') border border-red-500 @enderror bg-slate-100"
                    type="email" name="email" placeholder="abc@gmail.com">
                @error('email')
                    <p class="text-red-500 text-center">{{ $message }}</p>
                @enderror
                <label class="font-semibold mb-2 mt-4" for="password">Password</label>
                <input class="p-4 rounded-xl bg-slate-100 @error('password') border border-red-500 @enderror"
                    type="password" name="password" placeholder="Password should be 8 char long">
                @error('password')
                    <p class="text-red-500 text-center">{{ $message }}</p>
                @enderror
                <input class="p-4 text-white font-bold bg-yellow-500 font-white rounded-xl mt-4" type="submit"
                    value="Login">
            </form>
            <p class="font-bold text-black text-center">or</p>
            <p class="text-center text-slate-500">Don't have an account ? <a class="text-yellow-500 font-bold"
                    href="{{ url('/register') }}">Signup</a></p>
        </div>

    </div>


</body>

</html>
