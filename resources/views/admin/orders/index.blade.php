<!DOCTYPE html>
<html>
<head>
    <title>Manage Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-7xl mx-auto px-6 py-8">

    <div class="bg-white rounded-2xl shadow p-6 mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-bold text-black">
                Manage Orders
            </h1>
            <p class="text-gray-600 mt-1">
                View customer orders, payment status and delivery progress.
            </p>
        </div>

        <a href="{{ route('admin.dashboard') }}"
           class="bg-black text-white px-6 py-3 rounded-xl font-bold hover:bg-gray-800">
            ← Back to Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-5 py-3 rounded-xl mb-6 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <table class="w-full border-collapse">
            <thead class="bg-gray-900 text-white">
                <tr>
                    <th class="p-4 text-left">Order ID</th>
                    <th class="p-4 text-left">Customer</th>
                    <th class="p-4 text-left">Total Amount</th>
                    <th class="p-4 text-left">Payment Method</th>
                    <th class="p-4 text-left">Payment Status</th>
                    <th class="p-4 text-left">Order Status</th>
                    <th class="p-4 text-left">Date</th>
                </tr>
            </thead>

            <tbody>
                @forelse($orders as $order)
                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-4 font-bold">
                            #{{ $order->id }}
                        </td>

                        <td class="p-4">
                            <div class="font-semibold">
                                {{ $order->full_name ?? $order->user->name ?? 'Unknown Customer' }}
                            </div>

                            <div class="text-sm text-gray-500">
                                {{ $order->phone ?? 'No phone' }}
                            </div>

                            <div class="text-sm text-gray-400">
                                {{ $order->email ?? $order->user->email ?? '' }}
                            </div>
                        </td>

                        <td class="p-4 font-bold">
                            Rs. {{ number_format($order->total_amount ?? 0) }}
                        </td>

                        <td class="p-4">
                            {{ $order->payment_method ?? 'N/A' }}
                        </td>

                        <td class="p-4">
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}"
                                  method="POST"
                                  class="flex gap-2 items-center">
                                @csrf
                                @method('PATCH')

                                <select name="payment_status"
                                        class="border rounded-lg px-3 py-2 text-sm">
                                    <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>

                                    <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>
                                        Paid
                                    </option>

                                    <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>
                                        Failed
                                    </option>

                                    <option value="refunded" {{ $order->payment_status == 'refunded' ? 'selected' : '' }}>
                                        Refunded
                                    </option>
                                </select>
                        </td>

                        <td class="p-4">
                                <select name="order_status"
                                        class="border rounded-lg px-3 py-2 text-sm">
                                    <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>

                                    <option value="confirmed" {{ $order->order_status == 'confirmed' ? 'selected' : '' }}>
                                        Confirmed
                                    </option>

                                    <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>
                                        Processing
                                    </option>

                                    <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>
                                        Shipped
                                    </option>

                                    <option value="out_for_delivery" {{ $order->order_status == 'out_for_delivery' ? 'selected' : '' }}>
                                        Out for Delivery
                                    </option>

                                    <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>
                                        Delivered
                                    </option>

                                    <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled
                                    </option>
                                </select>

                                <button type="submit"
                                        class="ml-2 bg-black text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-gray-800">
                                    Update
                                </button>
                            </form>
                        </td>

                        <td class="p-4">
                            {{ $order->created_at->format('d M Y') }}
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-gray-500">
                            No orders found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>

</body>
</html>