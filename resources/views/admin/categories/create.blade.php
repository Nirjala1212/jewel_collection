<h1>Add Category</h1>

<a href="{{ route('admin.categories.index') }}">Back</a>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p style="color:red;">{{ $error }}</p>
    @endforeach
@endif

<form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="text" name="name" placeholder="Category Name" required><br><br>

    <textarea name="description" placeholder="Description"></textarea><br><br>

    <input type="file" name="image"><br><br>

    <select name="status">
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select><br><br>

    <button type="submit">Save</button>
</form>