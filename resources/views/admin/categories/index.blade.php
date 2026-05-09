<h1>Manage Categories</h1>

<a href="{{ route('admin.dashboard') }}">Back to Dashboard</a> |
<a href="{{ route('admin.categories.create') }}">Add Category</a>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10" cellspacing="0" width="100%">
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Description</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>
                @if($category->image)
                    <img src="{{ asset('storage/'.$category->image) }}" width="70">
                @else
                    No Image
                @endif
            </td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->description }}</td>
            <td>{{ $category->status }}</td>
            <td>
                <a href="{{ route('admin.categories.edit', $category->id) }}">Edit</a>

                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete this category?')">Delete</button>
                </form>
            </td>
        </tr>
        
    @endforeach
</table>