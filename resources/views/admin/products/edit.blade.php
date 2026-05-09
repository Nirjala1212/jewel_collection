<h1>Edit Product</h1>

<a href="{{ route('admin.products.index') }}">Back to Products</a>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p style="color:red;">{{ $error }}</p>
    @endforeach
@endif

<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Category</label><br>
    <select name="category_id" required>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select><br><br>

    <label>Product Name</label><br>
    <input type="text" name="name" value="{{ $product->name }}" required><br><br>

    <label>Description</label><br>
    <textarea name="description">{{ $product->description }}</textarea><br><br>

    <label>Material</label><br>
    <input type="text" name="material" value="{{ $product->material }}"><br><br>

    <label>Weight</label><br>
    <input type="number" step="0.01" name="weight" value="{{ $product->weight }}"><br><br>

    <label>Price</label><br>
    <input type="number" step="0.01" name="price" value="{{ $product->price }}" required><br><br>

    <label>Discount</label><br>
    <input type="number" step="0.01" name="discount" value="{{ $product->discount }}"><br><br>

    <label>Stock Quantity</label><br>
    <input type="number" name="stock_quantity" value="{{ $product->stock_quantity }}" required><br><br>

    <label>Low Stock Threshold</label><br>
    <input type="number" name="low_stock_threshold" value="{{ $product->low_stock_threshold }}" required><br><br>

    <label>Current Image</label><br>
    @if($product->image)
        <img src="{{ asset('storage/'.$product->image) }}" width="100">
    @else
        <p>No Image</p>
    @endif

    <br><br>

    <label>Change Image</label><br>
    <input type="file" name="image"><br><br>

    <button type="submit">Update Product</button>
</form>