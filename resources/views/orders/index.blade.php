<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f4f1ec] min-h-screen py-10 px-6">

<div class="max-w-6xl mx-auto">

    <a href="{{ route('user.dashboard') }}"
       class="inline-block bg-black text-white px-6 py-3 rounded-full font-bold mb-8">
        ← Back to Dashboard
    </a>

    <h1 class="text-4xl font-bold text-center mb-10">My Orders</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-6 py-4 rounded-xl mb-6 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 px-6 py-4 rounded-xl mb-6 font-semibold">
            {{ session('error') }}
        </div>
    @endif

@forelse($orders as $index => $order)
    <div class="bg-white rounded-3xl shadow-xl p-8 mb-8">

        <div class="flex justify-between items-start mb-6">
            <div>
                <h2 class="text-2xl font-bold">
                    Order #{{ $orders->count() - $index }}
                </h2>

                <p class="text-gray-500">
                    {{ $order->created_at->format('d M Y, h:i A') }}
                </p>
            </div>
                <div class="text-right">
                    <p class="font-bold text-xl">
                        Rs. {{ number_format($order->total_amount) }}
                    </p>

                    <p class="text-sm mt-1">
                        Payment:
                        <span class="font-bold
                            @if($order->payment_status === 'paid')
                                text-green-600
                            @elseif($order->payment_status === 'failed')
                                text-red-600
                            @else
                                text-yellow-600
                            @endif
                        ">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </p>

                    <p class="text-sm">
                        Order:
                        <span class="font-bold
                            @if($order->order_status === 'confirmed')
                                text-green-600
                            @elseif($order->order_status === 'cancelled')
                                text-red-600
                            @else
                                text-yellow-600
                            @endif
                        ">
                            {{ ucfirst($order->order_status) }}
                        </span>
                    </p>
                </div>
            </div>

            @if($order->payment_method === 'ESEWA' && $order->payment_status !== 'paid')
                <a href="{{ route('esewa.pay', $order->id) }}"
                   class="inline-block mb-5 bg-green-600 text-white px-6 py-3 rounded-full font-bold hover:bg-green-700 transition">
                    Pay Again with eSewa
                </a>
            @endif

            <div class="border-t pt-5">
                @foreach($order->items as $item)
                    <div class="flex justify-between py-3 border-b">
                        <div>
                            <p class="font-bold">
                                {{ $item->product->name ?? 'Product Deleted' }}
                            </p>

                            <p class="text-gray-500 text-sm">
                                Qty: {{ $item->quantity }}
                            </p>
                        </div>

                        <p class="font-semibold">
                            Rs. {{ number_format($item->price_at_purchase * $item->quantity) }}
                        </p>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 text-gray-700">
                <p><strong>Name:</strong> {{ $order->full_name }}</p>
                <p><strong>Email:</strong> {{ $order->email }}</p>
                <p><strong>Phone:</strong> {{ $order->phone }}</p>

                <p>
                    <strong>Address:</strong>
                    {{ $order->area }},
                    {{ $order->city }},
                    {{ $order->province }}
                </p>

                <p><strong>Street:</strong> {{ $order->delivery_address }}</p>

                @if($order->landmark)
                    <p><strong>Landmark:</strong> {{ $order->landmark }}</p>
                @endif

                @if($order->esewa_ref_id)
                    <p><strong>eSewa Ref ID:</strong> {{ $order->esewa_ref_id }}</p>
                @endif
            </div>

        </div>
    @empty
        <div class="bg-white rounded-3xl shadow-xl p-10 text-center">
            <p class="text-gray-500 text-xl">You have no orders yet.</p>
        </div>
    @endforelse

</div>

</body>
</html>