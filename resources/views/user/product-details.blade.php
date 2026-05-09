<!DOCTYPE html>
<html>
<head>
    <title>{{ $product->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-6xl mx-auto py-12 px-6">
    <a href="{{ route('user.dashboard') }}" class="text-gray-700 hover:underline">
        ← Back to Dashboard
    </a>

    <div class="bg-white rounded-2xl shadow mt-8 grid grid-cols-1 md:grid-cols-2 gap-10 p-8">
        <div>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                     class="w-full h-[500px] object-cover rounded-xl">
            @else
                <div class="h-[500px] bg-gray-200 flex items-center justify-center rounded-xl">
                    No Image
                </div>
            @endif
        </div>

        <div>
            <h1 class="text-4xl font-bold">{{ $product->name }}</h1>

            <p class="text-gray-500 mt-3">
                {{ $product->material ?? 'Material not specified' }}
            </p>

            <h2 class="text-3xl font-bold mt-6">
                Rs. {{ number_format($product->price) }}
            </h2>

            <p class="text-gray-700 mt-6">
                {{ $product->description }}
            </p>

            <p class="mt-6">
                <strong>Stock:</strong> {{ $product->stock_quantity }}
            </p>

<form action="{{ route('cart.store', $product->id) }}" method="POST" class="mt-8">
    @csrf

    <label class="block font-bold mb-2">Select Quantity</label>

    <input type="number"
           name="quantity"
           value="1"
           min="1"
           max="{{ $product->stock_quantity }}"
           class="w-24 border border-gray-400 rounded-lg px-4 py-2 mb-5">

    <br>

    <button type="submit"
            class="bg-black text-white px-10 py-4 rounded-full hover:bg-yellow-500 hover:text-black transition">
        Add to Cart
    </button>
    <div class="mt-12 border-t pt-8">
    <h2 class="text-2xl font-bold mb-6">Product Reviews</h2>

    @if(isset($reviews) && $reviews->count() > 0)
        @foreach($reviews as $review)
            <div class="border rounded-xl p-5 mb-4">
                <p class="text-yellow-500 text-lg">
                    @for($i = 1; $i <= $review->rating; $i++)
                        ★
                    @endfor
                </p>

                <p class="text-gray-700 mt-2">
                    {{ $review->comment }}
                </p>

                <p class="font-bold mt-3">
                    {{ $review->user->name ?? 'Customer' }}
                </p>
            </div>
        @endforeach
    @else
        <p class="text-gray-500">
            No reviews yet. Be the first to review this product.
        </p>
    @endif
</div>
</form>
        </div>
    </div>
</div>

</body>
</html>