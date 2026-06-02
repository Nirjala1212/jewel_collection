<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f7f4ee] min-h-screen">

<div class="max-w-4xl mx-auto py-10 px-6">

    <div class="bg-white rounded-3xl shadow-2xl p-10 border border-yellow-200">

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-black">Add Product</h1>

            <a href="{{ route('admin.products.index') }}"
               class="bg-black text-white px-5 py-3 rounded-full font-semibold hover:bg-yellow-500 hover:text-black transition">
                ← Back to Products
            </a>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="font-semibold text-gray-700">Category</label>
                    <select name="category_id"
                            class="w-full mt-2 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-400 outline-none">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="font-semibold text-gray-700">Product Name</label>
                    <input type="text" name="name"
                           class="w-full mt-2 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="font-semibold text-gray-700">Description</label>
                    <textarea name="description" rows="4"
                              class="w-full mt-2 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-400 outline-none"></textarea>
                </div>

                <div>
                    <label class="font-semibold text-gray-700">Material</label>
                    <input type="text" name="material" placeholder="Gold, Silver, Diamond"
                           class="w-full mt-2 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div>
                    <label class="font-semibold text-gray-700">Weight (grams)</label>
                    <input type="number" step="0.01" name="weight"
                           class="w-full mt-2 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div>
                    <label class="font-semibold text-gray-700">Price (Rs.)</label>
                    <input type="number" name="price"
                           class="w-full mt-2 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div>
                    <label class="font-semibold text-gray-700">Discount (%)</label>
                    <input type="number" name="discount" value="0"
                           class="w-full mt-2 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div>
                    <label class="font-semibold text-gray-700">Stock Quantity</label>
                    <input type="number" name="stock_quantity"
                           class="w-full mt-2 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div>
                    <label class="font-semibold text-gray-700">Low Stock Threshold</label>
                    <input type="number" name="low_stock_threshold" value="5"
                           class="w-full mt-2 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-yellow-400 outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="font-semibold text-gray-700">Product Image</label>
                    <input type="file" name="image"
                           class="w-full mt-2 border border-gray-300 rounded-xl px-4 py-3 bg-white">
                </div>

            </div>

            <button type="submit"
                    class="mt-8 w-full bg-yellow-500 text-black py-4 rounded-full text-lg font-bold hover:bg-black hover:text-white transition shadow-lg">
                Save Product
            </button>

        </form>

    </div>

</div>

</body>
</html>