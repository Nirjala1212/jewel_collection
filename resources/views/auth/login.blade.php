<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#f4f1ec] flex items-center justify-center px-4">

<div class="w-full max-w-5xl bg-white rounded-[28px] shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2">

    <div class="hidden md:flex flex-col justify-center p-12 bg-black text-white">
        <p class="text-yellow-400 uppercase tracking-[4px] font-bold mb-4">
            Welcome Back
        </p>

        <h1 class="text-5xl font-bold leading-tight mb-6">
            Luxury Jewellery Collection
        </h1>

        <p class="text-gray-300 leading-7">
            Login to explore premium rings, bangles, necklaces and handmade jewellery.
        </p>
    </div>

    <div class="p-10 md:p-14">

<a href="{{ route('landing') }}"
   class="inline-flex items-center gap-2 mb-8 border-2 border-[#b08d57] text-[#b08d57] px-5 py-3 rounded-xl font-bold hover:bg-[#b08d57] hover:text-black transition duration-300">
    ← Back to Home
</a>
        <h2 class="text-4xl font-bold text-gray-900 mb-3">
            Login
        </h2>

        <p class="text-gray-500 mb-8">
            Enter your email and password to continue.
        </p>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl mb-5">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded-xl mb-5">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="mb-5">
                <label class="block font-semibold text-gray-700 mb-2">
                    Email Address
                </label>

                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>

            <div class="mb-6">
                <label class="block font-semibold text-gray-700 mb-2">
                    Password
                </label>

                <input type="password"
                       name="password"
                       required
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>

            <button type="submit"
                    class="w-full bg-black text-white py-4 rounded-full font-bold hover:bg-[#b08d57] transition duration-300 shadow-lg">
                Login
            </button>
        </form>

        <p class="text-center text-gray-600 mt-8">
            Don’t have account?
            <a href="{{ route('register') }}" class="font-bold text-[#9a6a32] hover:underline">
                Register
            </a>
        </p>

    </div>

</div>

</body>
</html>