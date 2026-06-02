<!DOCTYPE html>
<html>
<head>
    <title>{{ $product->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f4f1ec] min-h-screen">

<div class="max-w-6xl mx-auto py-10 px-6">

    <div class="bg-white rounded-[26px] shadow-xl p-8 border border-[#eee4d8]">

        <div class="bg-black inline-block rounded-full mb-8 shadow-lg">
            <a href="{{ route('user.dashboard') }}"
               class="inline-flex items-center gap-2 text-white px-6 py-3 rounded-full hover:bg-[#b08d57] transition duration-300 font-medium">
                <span class="text-lg">←</span>
                <span>Back</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            <div>
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         class="w-full h-[500px] object-cover rounded-[20px] border border-gray-100">
                @else
                    <div class="h-[500px] bg-gray-100 flex items-center justify-center rounded-[20px]">
                        No Image
                    </div>
                @endif
            </div>

            <div class="flex flex-col justify-center px-2">
                <p class="text-sm uppercase tracking-[3px] text-gray-500 mb-3">
                    {{ $product->material ?? 'Premium Jewellery' }}
                </p>

                <h1 class="text-4xl font-semibold text-gray-900 leading-tight mb-4">
                    {{ $product->name }}
                </h1>

                <div class="w-16 h-[2px] bg-[#b08d57] mb-5"></div>

                <h2 class="text-3xl font-semibold text-[#9a6a32] mb-6">
                    Rs. {{ number_format($product->price) }}
                </h2>

                <p class="text-gray-600 leading-8 mb-6">
                    {{ $product->description }}
                </p>

                <div class="mb-6 border-t border-b border-gray-200 py-4">
                    <p class="text-gray-700">
                        <span class="font-semibold">Available Stock:</span>
                        {{ $product->stock_quantity }}
                    </p>
                </div>

                <form action="{{ route('cart.store', $product->id) }}" method="POST">
                    @csrf

                    <label class="block font-medium mb-2 text-gray-800">
                        Select Quantity
                    </label>

                    <input type="number"
                           name="quantity"
                           value="1"
                           min="1"
                           max="{{ $product->stock_quantity }}"
                           class="w-24 border border-gray-300 rounded-lg px-4 py-2 mb-6 focus:outline-none focus:ring-1 focus:ring-[#b08d57]">

                    <div class="flex gap-4 mt-6">
                        <button type="submit"
                                class="bg-black text-white px-10 py-4 rounded-full font-bold hover:bg-yellow-500 hover:text-black transition">
                            Add to Cart
                        </button>

                        <button type="submit" name="buy_now" value="1"
                                class="bg-yellow-500 text-black px-10 py-4 rounded-full font-bold hover:bg-black hover:text-white transition">
                            Order Now
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="bg-white rounded-[24px] shadow-md mt-8 p-8 border border-[#eee4d8]">
        <h2 class="text-2xl font-semibold mb-6 text-gray-900">Product Reviews</h2>

        @if($product->reviews->count() > 0)
            @foreach($product->reviews as $review)
                <div class="border-b py-6">
                    <div class="flex items-center justify-between">
                        <h3 class="font-bold text-lg">
                            {{ $review->user->full_name ?? 'Customer' }}
                        </h3>

                        <span class="text-yellow-500 font-bold">
                            ⭐ {{ $review->rating }}/5
                        </span>
                    </div>

                    <p class="text-gray-600 mt-3">
                        {{ $review->comment }}
                    </p>

                    @if($review->image)
                        <img src="{{ asset('storage/' . $review->image) }}"
                             class="w-32 h-32 object-cover rounded-xl mt-4 border">
                    @endif
                </div>
            @endforeach
        @else
            <p class="text-gray-500 mb-6">
                No reviews yet. Be the first to review this product.
            </p>
        @endif

        <form action="{{ route('reviews.store', $product->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="mt-8">
            @csrf

            <label class="font-bold block mb-2">
                Upload Review Image
            </label>

            <input type="file"
                   name="image"
                   class="w-full border rounded-xl px-4 py-3 bg-white mb-4">

            <label class="font-bold">Rating</label>
            <select name="rating" class="w-full border rounded-xl px-4 py-3 mt-2 mb-4">
                <option value="5">5 Stars</option>
                <option value="4">4 Stars</option>
                <option value="3">3 Stars</option>
                <option value="2">2 Stars</option>
                <option value="1">1 Star</option>
            </select>

            <label class="font-bold">Your Review</label>
            <textarea name="comment"
                      class="w-full border rounded-xl px-4 py-3 mt-2"
                      rows="4"
                      placeholder="Write your review here..."></textarea>

            <button type="submit"
                    class="mt-4 bg-pink-600 text-white px-8 py-3 rounded-full font-bold">
                Submit Review
            </button>
        </form>
    </div>

</div>

</body>
</html>