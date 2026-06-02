<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-pink-50 min-h-screen p-8">

    <div class="max-w-7xl mx-auto">

        <div class="flex justify-between items-center mb-8">

            <h1 class="text-5xl font-bold text-yellow-700">
                Manage Categories
            </h1>

            <div class="flex gap-4">

                <a href="{{ route('admin.dashboard') }}"
                   class="bg-gray-800 hover:bg-black text-white px-6 py-3 rounded-xl shadow-lg transition duration-300">
                    Back to Dashboard
                </a>

                <a href="{{ route('admin.categories.create') }}"
                   class="bg-yellow-600 hover:bg-black-700 text-white px-6 py-3 rounded-xl shadow-lg transition duration-300">
                    + Add Category
                </a>

            </div>

        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-6 py-4 rounded-xl mb-6 shadow">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">

            <table class="w-full">

                <thead class="bg-gradient-to-r from-yellow-600 to-yellow-500 text-white">

                    <tr>

                        <th class="py-5 px-4 text-center">ID</th>

                        <th class="py-5 px-4 text-center">Image</th>

                        <th class="py-5 px-4 text-center">Name</th>

                        <th class="py-5 px-4 text-center">Description</th>

                        <th class="py-5 px-4 text-center">Status</th>

                        <th class="py-5 px-4 text-center">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($categories as $category)

                        <tr class="border-b hover:bg-pink-50 transition duration-300">

                            <td class="py-5 px-4 text-center font-semibold text-gray-700">
                                {{ $category->id }}
                            </td>

                            <td class="py-5 px-4 text-center">

                                @if($category->image)

                                    <img src="{{ asset('storage/'.$category->image) }}"
                                         class="w-24 h-24 object-cover rounded-2xl mx-auto shadow-lg border-4 border-pink-100 hover:scale-105 transition duration-300">

                                @else

                                    <div class="w-24 h-24 rounded-2xl bg-gray-100 flex items-center justify-center mx-auto text-gray-400 shadow">
                                        No Image
                                    </div>

                                @endif

                            </td>

                            <td class="py-5 px-4 text-center font-bold text-gray-800 text-lg">
                                {{ $category->name }}
                            </td>

                            <td class="py-5 px-4 text-center text-gray-600">
                                {{ $category->description }}
                            </td>

                            <td class="py-5 px-4 text-center">

                                <span class="bg-green-100 text-green-700 px-5 py-2 rounded-full text-sm font-semibold shadow">
                                    {{ $category->status }}
                                </span>

                            </td>

                            <td class="py-5 px-4">

                                <div class="flex justify-center gap-3">

                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-xl shadow-md transition duration-300">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this category?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-xl shadow-md transition duration-300">
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