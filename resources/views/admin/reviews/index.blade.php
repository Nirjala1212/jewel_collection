<!DOCTYPE html>
<html>
<head>
    <title>Customer Reviews</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8">

<h1 class="text-4xl font-bold mb-8">Customer Reviews</h1>

<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.dashboard') }}"
       style="background:#111827; color:white; padding:12px 22px; border-radius:10px; text-decoration:none; font-weight:bold; display:inline-block; transition:0.3s;"
       onmouseover="this.style.background='#facc15'; this.style.color='black';"
       onmouseout="this.style.background='#111827'; this.style.color='white';">
        ← Back to Dashboard
    </a>
</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-900 text-white">
            <tr>
                <th class="p-4">Customer</th>
                <th class="p-4">Product</th>
                <th class="p-4">Rating</th>
                <th class="p-4">Review</th>
                <th class="p-4">Image</th>
                <th class="p-4">Date</th>
            </tr>
        </thead>

        <tbody>
            @forelse($reviews as $review)
                <tr class="border-b">
                    <td class="p-4">
                        {{ $review->user->full_name ?? 'Unknown User' }}
                    </td>

                    <td class="p-4 font-bold">
                        {{ $review->product->name ?? 'Product Deleted' }}
                    </td>

                    <td class="p-4 text-yellow-500 font-bold">
                        {{ $review->rating }} ★
                    </td>

                    <td class="p-4">
                        {{ $review->comment }}
                    </td>

                    <td class="p-4">
                        @if($review->image)
                            <img src="{{ asset('storage/' . $review->image) }}"
                                 class="w-24 h-24 object-cover rounded-xl">
                        @else
                            <span class="text-gray-400">No Image</span>
                        @endif
                    </td>

                    <td class="p-4">
                        {{ $review->created_at->format('d M Y') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-6 text-center text-gray-500">
                        No reviews found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>