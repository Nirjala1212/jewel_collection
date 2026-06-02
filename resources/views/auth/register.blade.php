<!DOCTYPE html>
<html>
<head>
    <title>User Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#f4f1ec] flex items-center justify-center px-4 py-10">

<div class="w-full max-w-6xl bg-white rounded-[30px] shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2">

    <!-- Left Side -->
    <div class="hidden md:flex flex-col justify-center bg-black text-white p-14">

        <p class="text-yellow-400 uppercase tracking-[4px] font-bold mb-4">
            Join Us
        </p>

        <h1 class="text-5xl font-bold leading-tight mb-6">
            Create Your Jewellery Account
        </h1>

        <p class="text-gray-300 leading-8 text-lg">
            Register now to explore premium collections, manage your cart,
            save orders and enjoy luxury shopping experience.
        </p>

    </div>

    <div class="p-10 md:p-14">
       <a href="{{ route('landing') }}"
       class="inline-flex items-center gap-2 mb-6 bg-black text-white px-5 py-3 rounded-full font-bold shadow-lg hover:bg-[#b08d57] transition duration-300">
        ← Back to Home
    </a>

        <h2 class="text-4xl font-bold text-gray-900 mb-2">
            User Register
        </h2>

        <p class="text-gray-500 mb-8">
            Fill all details to create your account.
        </p>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded-xl mb-6">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register.post') }}">

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div class="md:col-span-2">
                    
                    <label class="block font-semibold mb-2 text-gray-700">
                        Full Name
                    </label>

                    <input type="text"
                           name="name"
                           placeholder="Enter full name"
                           required
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

                <div class="md:col-span-2">
                    <label class="block font-semibold mb-2 text-gray-700">
                        Email Address
                    </label>

                    <input type="email"
                           name="email"
                           placeholder="Enter email address"
                           required
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

                <div>
                    <label class="block font-semibold mb-2 text-gray-700">
                        Password
                    </label>

                    <input type="password"
                           name="password"
                           placeholder="Enter password"
                           required
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

                <div>
                    <label class="block font-semibold mb-2 text-gray-700">
                        Confirm Password
                    </label>

                    <input type="password"
                           name="password_confirmation"
                           placeholder="Confirm password"
                           required
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

                <div>
                    <label class="block font-semibold mb-2 text-gray-700">
                        Phone
                    </label>

                    <input type="text"
                           name="phone"
                           placeholder="Enter phone number"
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

                <div>
                    <label class="block font-semibold mb-2 text-gray-700">
                        Address
                    </label>

                    <input type="text"
                           name="address"
                           placeholder="Enter address"
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

            </div>

            <button type="submit"
                    class="w-full bg-black text-white py-4 rounded-full font-bold mt-8 hover:bg-[#b08d57] transition duration-300 shadow-lg">
                Register
            </button>

        </form>

        <p class="text-center text-gray-600 mt-8">
            Already have account?
            <a href="{{ route('login') }}"
               class="font-bold text-[#9a6a32] hover:underline">
                Login
            </a>
        </p>

    </div>

</div>

</body>
</html>