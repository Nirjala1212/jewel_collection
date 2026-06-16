<!DOCTYPE html>
<html>
<head>
    <title>{{ $category->name }} Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f4f1ec] min-h-screen">

<section class="py-16 px-6">

    <div class="max-w-7xl mx-auto">

        <a href="{{ route('user.dashboard') }}"
           class="inline-block bg-black text-white px-8 py-3 rounded-full font-bold hover:bg-gray-800 transition mb-10">
            ← Back
        </a>

        <h1 class="text-5xl font-bold text-black text-center mb-14">
            {{ ucfirst($category->name) }} Collection
        </h1>

        @if($products->count() > 0)

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                @foreach($products as $product)

                    <div class="bg-white rounded-[24px] shadow-xl overflow-hidden hover:shadow-2xl transition">

                        <a href="{{ route('product.show', $product->id) }}">
                            <div class="relative h-[320px] bg-gray-100 overflow-hidden">

                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400 text-lg">
                                        No Image
                                    </div>
                                @endif

                                @if(($product->stock_quantity ?? 10) <= 5)
                                    <span class="absolute top-4 left-4 bg-red-600 text-white text-xs px-4 py-2 rounded-full font-bold">
                                        LOW STOCK
                                    </span>
                                @endif

                            </div>
                        </a>

                        <div class="p-6">

                            <p class="text-gray-400 text-sm uppercase tracking-widest">
                                {{ $product->category->name ?? 'Jewellery' }}
                            </p>

                            <h3 class="font-bold text-2xl mt-3 text-black">
                                {{ $product->name }}
                            </h3>

                            <p class="text-gray-500 mt-2 text-lg">
                                {{ $product->material ?? '' }}
                            </p>

                            <h4 class="text-2xl font-bold text-black mt-6">
                                Rs. {{ number_format($product->price) }}
                            </h4>

                            <div class="flex gap-4 mt-6">

                                <a href="{{ route('product.show', $product->id) }}"
                                   class="bg-black text-white px-7 py-3 rounded-full font-bold text-base hover:bg-gray-800 transition">
                                    View Details
                                </a>

                                @auth
                                    <a href="{{ route('product.show', $product->id) }}"
                                       class="border border-black text-black px-7 py-3 rounded-full font-bold text-base hover:bg-black hover:text-white transition">
                                        Add Cart
                                    </a>
                                @else
                                    <a href="{{ route('login') }}"
                                       class="border border-black text-black px-7 py-3 rounded-full font-bold text-base hover:bg-black hover:text-white transition">
                                        Add Cart
                                    </a>
                                @endauth

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="bg-white rounded-3xl shadow-xl p-10 text-center">
                <h2 class="text-2xl font-bold text-gray-700">
                    No products available in this category.
                </h2>
            </div>

        @endif

    </div>

</section>

</body>
</html>