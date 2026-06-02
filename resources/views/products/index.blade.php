<!DOCTYPE html>
<html>
<head>
    <title>All Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-7xl mx-auto py-10 px-6">

    <div class="flex justify-between items-center mb-8">
        <div>
            <a href="{{ route('admin.dashboard') }}"
               class="inline-block mb-4 text-gray-600 hover:text-black font-semibold">
                ← Back to Admin Dashboard
            </a>

            <h1 class="text-4xl font-bold text-black">All Products</h1>
        </div>

        <a href="{{ route('admin.products.create') }}"
           class="bg-black text-white px-6 py-3 rounded-full font-bold hover:bg-yellow-500 hover:text-black transition">
            + Add New Product
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-5 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">

        <table class="w-full border-collapse">
            <thead class="bg-black text-white">
                <tr>
                    <th class="px-4 py-4 text-left">ID</th>
                    <th class="px-4 py-4 text-left">Category</th>
                    <th class="px-4 py-4 text-left">Name</th>
                    <th class="px-4 py-4 text-left">Material</th>
                    <th class="px-4 py-4 text-left">Price</th>
                    <th class="px-4 py-4 text-left">Discount</th>
                    <th class="px-4 py-4 text-left">Final Price</th>
                    <th class="px-4 py-4 text-left">Stock</th>
                    <th class="px-4 py-4 text-left">Image</th>
                    <th class="px-4 py-4 text-left">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($products as $product)
                    <tr class="border-b hover:bg-gray-50">

                        <td class="px-4 py-4">{{ $product->id }}</td>

                        <td class="px-4 py-4">
                            {{ $product->category->name ?? 'No Category' }}
                        </td>

                        <td class="px-4 py-4 font-bold">
                            {{ $product->name }}
                        </td>

                        <td class="px-4 py-4">
                            {{ $product->material }}
                        </td>

                        <td class="px-4 py-4">
                            Rs. {{ number_format($product->price) }}
                        </td>

                        <td class="px-4 py-4">
                            {{ $product->discount }}%
                        </td>

                        <td class="px-4 py-4 font-bold">
                            Rs. {{ number_format($product->final_price) }}
                        </td>

                        <td class="px-4 py-4">
                            @if($product->stock_quantity <= $product->low_stock_threshold)
                                <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-bold">
                                    {{ $product->stock_quantity }}
                                </span>
                            @else
                                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-bold">
                                    {{ $product->stock_quantity }}
                                </span>
                            @endif
                        </td>

                        <td class="px-4 py-4">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     class="w-20 h-20 object-cover rounded-xl shadow">
                            @else
                                <span class="text-gray-400">No Image</span>
                            @endif
                        </td>

                        <td class="px-4 py-4">
                            <div class="flex gap-2">

                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                   class="bg-yellow-500 text-black px-4 py-2 rounded-lg font-bold hover:bg-yellow-400">
                                    Edit
                                </a>

                                <form action="{{ route('admin.products.destroy', $product->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            onclick="return confirm('Delete this product?')"
                                            class="bg-red-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-red-500">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>

</body>
</html>