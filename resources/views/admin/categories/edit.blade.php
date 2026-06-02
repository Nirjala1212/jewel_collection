<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-pink-50 min-h-screen p-8">

<div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-2xl p-8">

    <h1 class="text-4xl font-bold text-black-700 mb-8">
        Edit Category
    </h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-xl mb-5">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.categories.update', $category->id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-6">

        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold mb-2">Category Name</label>
            <input type="text"
                   name="name"
                   value="{{ old('name', $category->name) }}"
                   class="w-full border rounded-xl px-4 py-3">
        </div>

        <div>
            <label class="block font-semibold mb-2">Description</label>
            <textarea name="description"
                      class="w-full border rounded-xl px-4 py-3">{{ old('description', $category->description) }}</textarea>
        </div>

        <div>
            <label class="block font-semibold mb-2">Current Image</label>

            @if($category->image)
                <img src="{{ asset('storage/'.$category->image) }}"
                     class="w-32 h-32 object-cover rounded-2xl shadow mb-3">
            @else
                <p class="text-gray-400 mb-3">No Image</p>
            @endif

            <input type="file"
                   name="image"
                   class="w-full border rounded-xl px-4 py-3 bg-white">
        </div>

        <div>
            <label class="block font-semibold mb-2">Status</label>

            <select name="status"
                    class="w-full border rounded-xl px-4 py-3 bg-white">

                <option value="active" {{ old('status', $category->status) == 'active' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="inactive" {{ old('status', $category->status) == 'inactive' ? 'selected' : '' }}>
                    Inactive
                </option>

            </select>
        </div>

        <div class="flex gap-4 pt-4">

            <button type="submit"
                    class="bg-yellow-600 hover:bg-pink-700 text-white px-6 py-3 rounded-xl shadow">
                Update Category
            </button>

            <a href="{{ route('admin.categories.index') }}"
               class="bg-gray-700 hover:bg-black text-white px-6 py-3 rounded-xl shadow">
                Back
            </a>

        </div>

    </form>

</div>

</body>
</html>