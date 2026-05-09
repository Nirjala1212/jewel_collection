<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-black text-white">

<!-- NAVBAR -->
<div class="absolute top-0 left-0 w-full z-30 flex justify-between items-center px-10 py-6">
    <h1 class="text-xl font-bold text-yellow-400 tracking-wide">JEWEL COLLECTION</h1>

    <div class="flex gap-8 text-white font-semibold">
        <a href="{{ route('user.dashboard') }}" class="hover:text-yellow-400">HOME</a>
        <a href="#gallery" class="hover:text-yellow-400">GALLERY</a>
      <a href="#about-us" class="hover:text-yellow-400">ABOUT US</a>

    </div>

    <div class="flex gap-5 text-white font-semibold">
        <a href="{{ route('orders.index') }}" class="hover:text-yellow-400">My Orders</a>
        <a href="{{ route('cart.index') }}" class="hover:text-yellow-400">Cart</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="hover:text-yellow-400">Logout</button>
        </form>
    </div>
</div>

<!-- HERO -->
<div class="relative h-[95vh] w-full overflow-hidden">

    <div id="slider" class="absolute inset-0">
        <img src="{{ asset('images/jewel1.png') }}" class="slide absolute inset-0 w-full h-full object-cover object-center opacity-100 transition-opacity duration-1000">
        <img src="{{ asset('images/jewel2.png') }}" class="slide absolute inset-0 w-full h-full object-cover object-center opacity-0 transition-opacity duration-1000">
        <img src="{{ asset('images/jewel3.png') }}" class="slide absolute inset-0 w-full h-full object-cover object-center opacity-0 transition-opacity duration-1000">
        <img src="{{ asset('images/jewel4.png') }}" class="slide absolute inset-0 w-full h-full object-cover object-center opacity-0 transition-opacity duration-1000">
        <img src="{{ asset('images/jewel5.png') }}" class="slide absolute inset-0 w-full h-full object-cover object-center opacity-0 transition-opacity duration-1000">
        <img src="{{ asset('images/jewel6.png') }}" class="slide absolute inset-0 w-full h-full object-cover object-center opacity-0 transition-opacity duration-1000">
        <img src="{{ asset('images/jewel7.png') }}" class="slide absolute inset-0 w-full h-full object-cover object-center opacity-0 transition-opacity duration-1000">
        <img src="{{ asset('images/jewel8.png') }}" class="slide absolute inset-0 w-full h-full object-cover object-center opacity-0 transition-opacity duration-1000">
    </div>

    <div class="absolute inset-0 bg-black/35"></div>

    <div class="relative z-20 h-full flex items-center px-20">
        <div class="max-w-2xl">
            <p class="text-yellow-400 text-xl mb-2">Classy</p>

            <h1 class="text-7xl font-extrabold leading-tight">
                Shine On <br>
                <span class="text-yellow-400 italic">Your Most</span><br>
                Special Day
            </h1>

            <p class="mt-5 text-xl text-gray-100">
                Exquisite jewellery crafted to make every moment unforgettable.
            </p>

            <div class="mt-8">
                <a href="{{ route('products.index') }}"
                   class="bg-yellow-500 hover:bg-yellow-400 text-black font-bold px-10 py-4 rounded-full text-lg transition">
                    SHOP COLLECTION
                </a>
            </div>
        </div>
    </div>
</div>

<!-- FEATURED PRODUCTS -->
<section class="relative z-20 bg-white text-black py-20 px-10">
    <div class="text-center mb-12">
        <p class="text-yellow-600 tracking-widest text-sm font-bold">HANDPICKED FOR YOU</p>
        <h2 class="text-4xl font-bold">
            Featured <span class="text-yellow-600 italic">Pieces</span>
        </h2>
        <p class="text-gray-500 mt-3">
            Our most-loved jewellery selected from our latest collection.
        </p>
    </div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">

    @foreach($products as $product)

    <div onclick="window.location='{{ route('product.show', $product->id) }}'"
         class="bg-white rounded-2xl shadow border overflow-hidden hover:shadow-xl transition duration-300 cursor-pointer">

        <!-- Product Image -->
        <div class="relative h-72 bg-gray-100 flex items-center justify-center overflow-hidden">

            @if($product->image)

                <img src="{{ asset('storage/' . $product->image) }}"
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover">

            @else

                <div class="text-gray-400 text-lg">
                    No Image
                </div>

            @endif

            <!-- Low Stock -->
            @if(($product->stock_quantity ?? 10) <= 5)

                <span class="absolute top-4 left-4 bg-red-600 text-white text-xs px-4 py-2 rounded-full font-bold">
                    LOW STOCK
                </span>

            @endif

        </div>

        <!-- Product Details -->
        <div class="p-6">

            <p class="text-gray-400 text-sm uppercase tracking-widest">
                {{ $product->category->name ?? 'Jewellery' }}
            </p>

            <h3 class="font-bold text-2xl mt-2 text-black">
                {{ $product->name }}
            </h3>

            <p class="text-gray-500 mt-2">
                {{ $product->material ?? '' }}
            </p>

            <p class="text-gray-600 mt-3 line-clamp-2">
                {{ $product->description }}
            </p>

            <!-- Price + Cart -->
            <div class="flex justify-between items-center mt-6">

                <h4 class="text-2xl font-bold text-black">
                    Rs. {{ number_format($product->price) }}
                </h4>

                <form action="{{ route('cart.store', $product->id) }}"
                      method="POST"
                      onclick="event.stopPropagation();">

                    @csrf

                    <input type="hidden" name="quantity" value="1">


                </form>

            </div>

        </div>

    </div>

    @endforeach

</div>
    <div class="text-center mt-12">
        <a href="{{ route('products.index') }}"
           class="inline-block border border-black px-8 py-3 rounded-full font-bold hover:bg-black hover:text-white transition">
            View Entire Collection →
        </a>
    </div>
</section>

<section id="gallery" class="bg-black text-white py-24 px-10">
    <div class="text-center mb-12">
        <p class="text-yellow-400 tracking-widest text-sm font-bold">GALLERY</p>
        <h2 class="text-4xl font-bold">Our Luxury Collection</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 max-w-6xl mx-auto">
        <img src="{{ asset('images/jewel1.png') }}" class="h-64 w-full object-cover rounded-xl">
        <img src="{{ asset('images/jewel2.png') }}" class="h-64 w-full object-cover rounded-xl">
        <img src="{{ asset('images/jewel3.png') }}" class="h-64 w-full object-cover rounded-xl">
        <img src="{{ asset('images/jewel4.png') }}" class="h-64 w-full object-cover rounded-xl">
    </div>
</section>
<!-- ABOUT US -->
<!-- ABOUT US SECTION -->
<section id="about-us" class="bg-gradient-to-b from-white to-gray-100 py-28 px-6 md:px-16 overflow-hidden">

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">

        <!-- LEFT IMAGE SECTION -->
        <div class="relative">

            <!-- Main Image -->
            <img src="{{ asset('images/jewel5.png') }}"
                 alt="Luxury Jewellery"
                 class="rounded-[40px] shadow-2xl w-full h-[650px] object-cover">

            <!-- Floating Card -->
            <div class="absolute -bottom-10 -right-8 bg-white shadow-2xl rounded-3xl px-8 py-6 border border-gray-100">

                <h3 class="text-4xl font-black text-yellow-500">10+</h3>

                <p class="text-gray-600 mt-2 font-medium">
                    Years Of Luxury Craftsmanship
                </p>

            </div>

        </div>

        <!-- RIGHT CONTENT -->
        <div>

            <p class="text-yellow-500 tracking-[6px] uppercase font-bold text-sm mb-5">
                About Our Brand
            </p>

            <h2 class="text-5xl md:text-7xl font-black leading-tight text-black">
                Crafted To Make
                <span class="text-yellow-500 italic">
                    Every Moment
                </span>
                Shine
            </h2>

            <p class="text-gray-600 text-lg leading-9 mt-10">
                We believe jewellery is more than fashion —
                it is emotion, elegance, confidence, and timeless beauty.
                Every piece in our collection is carefully crafted with
                premium materials and luxurious finishing.
            </p>

            <p class="text-gray-600 text-lg leading-9 mt-6">
                From engagement rings to exclusive necklaces,
                our mission is to make every customer feel unique,
                confident, and unforgettable on their special day.
            </p>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-14">

    <!-- CARD 1 -->
    <div class="bg-gradient-to-br from-yellow-50 to-white rounded-[32px] p-8 shadow-2xl border border-yellow-100 hover:-translate-y-2 transition duration-300">

        <div class="w-20 h-20 rounded-full bg-yellow-100 flex items-center justify-center text-4xl shadow-md mb-6">
            💎
        </div>

        <h3 class="text-3xl font-black text-black tracking-wide">
            Premium Quality
        </h3>

        <p class="text-gray-600 mt-4 text-lg leading-8">
            Carefully handcrafted luxury jewellery made with elegance,
            beauty, and timeless perfection.
        </p>

    </div>

    <!-- CARD 2 -->
    <div class="bg-gradient-to-br from-black to-gray-900 rounded-[32px] p-8 shadow-2xl hover:-translate-y-2 transition duration-300">

        <div class="w-20 h-20 rounded-full bg-yellow-400 flex items-center justify-center text-4xl shadow-md mb-6">
            ✨
        </div>

        <h3 class="text-3xl font-black text-white tracking-wide">
            Elegant Design
        </h3>

        <p class="text-gray-300 mt-4 text-lg leading-8">
            Modern luxury collections designed to make every moment
            unforgettable and stylish.
        </p>

    </div>

</div>
        </div>

    </div>

</section><section class="bg-black text-white py-24 px-10">

    <div class="max-w-4xl mx-auto text-center">

        <p class="text-yellow-400 tracking-widest text-sm font-bold mb-4">
            CONTACT US
        </p>

        <h2 class="text-5xl font-bold">
            We'd Love To Hear From You
        </h2>

        <p class="text-gray-300 mt-6 text-lg leading-8">
            Have questions about our jewellery, orders, or custom collections?
            Contact us anytime and our team will assist you.
        </p>

        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="bg-white/10 rounded-2xl p-8">
                <h3 class="text-2xl font-bold mb-3">Phone</h3>
                <p class="text-gray-300">+977 9800000000</p>
            </div>

            <div class="bg-white/10 rounded-2xl p-8">
                <h3 class="text-2xl font-bold mb-3">Email</h3>
                <p class="text-gray-300">info@jewelcollection.com</p>
            </div>

            <div class="bg-white/10 rounded-2xl p-8">
                <h3 class="text-2xl font-bold mb-3">Address</h3>
                <p class="text-gray-300">Kathmandu, Nepal</p>
            </div>

        </div>

    </div>

</section>

<script>
let slides = document.querySelectorAll(".slide");
let index = 0;

setInterval(() => {
    slides[index].style.opacity = "0";
    index = (index + 1) % slides.length;
    slides[index].style.opacity = "1";
}, 3000);
</script>

</body>
</html>