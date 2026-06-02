<!DOCTYPE html>
<html>
<head>
    <title>My Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-5xl mx-auto py-12 px-6">

    <h1 class="text-4xl font-bold mb-8">My Cart</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-5 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($cartItems->count() > 0)

        <div class="bg-white rounded-xl shadow overflow-hidden">

            @php $total = 0; @endphp

            @foreach($cartItems as $item)

                @php
                    $subtotal = $item->product->price * $item->quantity;
                    $total += $subtotal;
                @endphp

                <div class="flex items-center justify-between border-b p-5">

                    <div class="flex items-center gap-5">
                        @if($item->product && $item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                 class="w-24 h-24 object-cover rounded">
                        @else
                            <div class="w-24 h-24 bg-gray-200 rounded flex items-center justify-center text-gray-500">
                                No Image
                            </div>
                        @endif

                        <div>
                            <h2 class="text-xl font-bold">
                                {{ $item->product->name ?? 'Product Deleted' }}
                            </h2>

                            <p class="text-gray-500">
                                Rs. {{ number_format($item->product->price ?? 0) }}
                            </p>

                            <p class="text-gray-500">
                                Quantity: {{ $item->quantity }}
                            </p>
                        </div>
                    </div>

                    <div class="text-right">
                        <p class="font-bold text-lg">
                            Rs. {{ number_format($subtotal) }}
                        </p>

                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="mt-3">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="text-red-600 font-semibold hover:underline">
                                Remove
                            </button>
                        </form>
                    </div>

                </div>

            @endforeach

            <div class="p-6 flex justify-between items-center">
                <h2 class="text-2xl font-bold">Total:</h2>
                <h2 class="text-2xl font-bold">Rs. {{ number_format($total) }}</h2>
            </div>

            <div class="p-6 flex justify-between">
                <a href="{{ route('user.dashboard') }}"
                   class="bg-gray-800 text-white px-6 py-3 rounded-full">
                    Continue Shopping
                </a>

                <a href="{{ route('checkout.create') }}"
                   class="bg-black hover:bg-yellow-500 hover:text-black text-white px-8 py-3 rounded-full font-semibold transition">
                    Proceed to Checkout
                </a>
            </div>

        </div>

    @else

        <div class="bg-white p-10 rounded-xl shadow text-center">
            <p class="text-gray-500 text-xl">Your cart is empty.</p>

            <a href="{{ route('user.dashboard') }}"
               class="inline-block mt-6 bg-black text-white px-8 py-3 rounded-full">
                Continue Shopping
            </a>
        </div>

    @endif

</div>

</body>
</html>