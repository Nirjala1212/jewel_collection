<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>

<h1>Add Product</h1>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <div>
        <label>Category:</label>
        <select name="category_id">
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <br>

    <div>
        <label>Product Name:</label>
        <input type="text" name="name">
    </div>

    <br>

    <div>
        <label>Description:</label>
        <textarea name="description"></textarea>
    </div>

    <br>

    <div>
        <label>Material:</label>
        <input type="text" name="material">
    </div>

    <br>

    <div>
        <label>Weight:</label>
        <input type="text" name="weight">
    </div>

    <br>

    <div>
        <label>Price:</label>
        <input type="text" name="price">
    </div>

    <br>

    <div>
        <label>Discount:</label>
        <input type="text" name="discount">
    </div>

    <br>

    <div>
        <label>Stock Quantity:</label>
        <input type="number" name="stock_quantity">
    </div>

    <br>

    <div>
        <label>Image Path:</label>
        <input type="text" name="image">
    </div>

    <br>

    <button type="submit">Save Product</button>
</form>

<br>

<a href="{{ route('products.index') }}">View All Products</a>

</body>
</html>