<!DOCTYPE html>
<html>
<head>
    <title>Stock Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-8">

<div class="max-w-7xl mx-auto bg-white rounded-2xl shadow-lg p-8">

    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Stock Management</h1>

        <a href="{{ route('admin.dashboard') }}"
           class="bg-black text-white px-5 py-3 rounded-lg hover:bg-yellow-500 hover:text-black">
            Back to Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-black text-white">
                <th class="p-4 text-left">Product</th>
                <th class="p-4 text-left">Category</th>
                <th class="p-4 text-left">Current Stock</th>
                <th class="p-4 text-left">Low Stock Limit</th>
                <th class="p-4 text-left">Status</th>
                <th class="p-4 text-left">Action</th>
            </tr>
        </thead>

<tbody>
@foreach($products as $product)
<tr class="border-b">

    <form action="{{ route('admin.stock.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <td class="p-4 font-semibold">
            {{ $product->name }}
        </td>

        <td class="p-4">
            {{ $product->category->name ?? 'No Category' }}
        </td>

        <td class="p-4">
            <input type="number"
                   name="stock_quantity"
                   value="{{ $product->stock_quantity }}"
                   class="w-24 border rounded-lg p-2">
        </td>

        <td class="p-4">
            <input type="number"
                   name="low_stock_threshold"
                   value="{{ $product->low_stock_threshold }}"
                   class="w-24 border rounded-lg p-2">
        </td>

        <td class="p-4">
            @if($product->stock_quantity == 0)
                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                    Out of Stock
                </span>
            @elseif($product->stock_quantity <= $product->low_stock_threshold)
                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                    Low Stock
                </span>
            @else
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                    In Stock
                </span>
            @endif
        </td>

        <td class="p-4">
            <button type="submit"
                    class="bg-yellow-500 text-black px-4 py-2 rounded-lg font-bold hover:bg-black hover:text-white">
                Update
            </button>
        </td>

    </form>
</tr>
@endforeach
</tbody>
    </table>

</div>

</body>
</html>