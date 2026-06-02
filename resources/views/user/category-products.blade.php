<!DOCTYPE html>
<html>
<head>
    <title>{{ $category->name }} Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-yellow-50 min-h-screen p-8">

<div class="max-w-7xl mx-auto">

    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold text-pink-700">
            {{ ucfirst($category->name) }} Products
        </h1>

        <a href="{{ route('user.dashboard') }}"
           class="bg-gray-800 text-white px-5 py-3 rounded-xl hover:bg-black">
            Back to Dashboard
        </a>
    </div>

@if($products->count() > 0)

<div class="grid grid-cols-1 md:grid-cols-3 gap-10">

    @foreach($products as $product)

        <div class="bg-white rounded-3xl shadow-xl border overflow-hidden hover:shadow-2xl transition duration-300 flex flex-col h-[760px]">

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

            <div class="p-7 flex flex-col flex-grow">

                <p class="text-gray-400 text-sm uppercase tracking-widest mb-3">
                    {{ $product->category->name ?? 'Jewellery' }}
                </p>

                <h3 class="font-bold text-3xl text-black mb-3">
                    {{ $product->name }}
                </h3>

                <p class="text-gray-500 mb-4">
                    {{ $product->material ?? '' }}
                </p>

                <div class="min-h-[90px]">
                    <p class="text-gray-600 text-lg">
                        {{ \Illuminate\Support\Str::limit($product->description, 80) }}
                    </p>
                </div>

                <div class="mt-auto">

                    <h4 class="text-3xl font-bold text-black mb-6">
                        Rs. {{ number_format($product->price) }}
                    </h4>

                    <div class="grid grid-cols-2 gap-4">

                        @auth
                            <a href="{{ route('product.show', $product->id) }}"
                               class="w-full text-center bg-black text-white px-5 py-4 rounded-full font-bold text-lg hover:bg-yellow-500 hover:text-black transition">
                                Add To Cart
                            </a>

                            <a href="{{ route('product.show', $product->id) }}"
                               class="w-full text-center bg-yellow-500 text-black px-5 py-4 rounded-full font-bold text-lg hover:bg-black hover:text-white transition">
                                Buy Now
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="w-full text-center bg-black text-white px-5 py-4 rounded-full font-bold text-lg hover:bg-yellow-500 hover:text-black transition">
                                Add To Cart
                            </a>

                            <a href="{{ route('login') }}"
                               class="w-full text-center bg-yellow-500 text-black px-5 py-4 rounded-full font-bold text-lg hover:bg-black hover:text-white transition">
                                Buy Now
                            </a>
                        @endauth

                    </div>

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