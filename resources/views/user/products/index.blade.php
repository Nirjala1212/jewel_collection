<!DOCTYPE html>
<html>
<head>
    <title>All Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f4f1ec] min-h-screen">

<div class="max-w-7xl mx-auto py-10 px-6">

    <div class="mb-8">
        <a href="{{ route('user.dashboard') }}"
           class="inline-block bg-black text-white px-6 py-3 rounded-full font-semibold hover:bg-[#b08d57] transition">
            ← Back
        </a>
    </div>

    <h1 class="text-4xl font-bold mb-10 text-center">
        Our Luxury Collection
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($products as $product)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

                <a href="{{ route('product.show', $product->id) }}">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="w-full h-72 object-cover">
                    @else
                        <div class="w-full h-72 bg-gray-200 flex items-center justify-center">
                            No Image
                        </div>
                    @endif
                </a>

                <div class="p-6">
                    <p class="text-sm uppercase tracking-widest text-gray-400">
                        {{ $product->category->name ?? 'Jewellery' }}
                    </p>

                    <h2 class="text-2xl font-bold mt-2">
                        {{ $product->name }}
                    </h2>

                    <p class="text-gray-600 mt-2">
                        {{ $product->material ?? 'Premium Material' }}
                    </p>

                    <p class="text-xl font-bold mt-4">
                        Rs. {{ number_format($product->price) }}
                    </p>

                    <div class="flex gap-3 mt-5">
                        <a href="{{ route('product.show', $product->id) }}"
                           class="bg-black text-white px-5 py-3 rounded-full font-semibold hover:bg-[#b08d57] transition">
                            View Details
                        </a>

                        <form action="{{ route('cart.store', $product->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="quantity" value="1">

                            <button type="submit"
                                    class="border border-black px-5 py-3 rounded-full font-semibold hover:bg-black hover:text-white transition">
                                Add Cart
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        @endforeach
    </div>

</div>

</body>
</html>