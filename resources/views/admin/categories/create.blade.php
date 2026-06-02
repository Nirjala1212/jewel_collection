<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-yellow-50 via-white to-yellow-100 min-h-screen">

<div class="max-w-3xl mx-auto py-12 px-6">

    <div class="bg-white rounded-3xl shadow-2xl p-10 border border-yellow-200">

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-black">
                Add Category
            </h1>

            <a href="{{ route('admin.categories.index') }}"
               class="bg-black text-white px-5 py-3 rounded-full font-semibold hover:bg-yellow-500 hover:text-black transition">
                ← Back
            </a>
        </div>

        <form action="{{ route('admin.categories.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="space-y-6">

                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        Category Name
                    </label>

                    <input type="text"
                           name="name"
                           placeholder="Enter category name"
                           class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 outline-none">
                </div>

                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        Description
                    </label>

                    <textarea name="description"
                              rows="4"
                              placeholder="Write category description..."
                              class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 outline-none"></textarea>
                </div>

                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        Category Image
                    </label>

                    <input type="file"
                           name="image"
                           class="w-full border border-gray-300 rounded-2xl p-4 bg-gray-50">
                </div>

                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        Status
                    </label>

                    <select name="status"
                            class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 outline-none">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <button type="submit"
                        class="w-full bg-yellow-500 text-black py-4 rounded-full font-bold text-lg hover:bg-black hover:text-white transition duration-300 shadow-lg">
                    Save Category
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>