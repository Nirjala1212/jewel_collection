<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>

<h1>Add Product</h1>

<a href="{{ route('admin.products.index') }}">← Back to Products</a>

<br><br>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p style="color:red;">{{ $error }}</p>
    @endforeach
@endif

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- CATEGORY -->
    <label>Category</label><br>
    <select name="category_id" required>
        <option value="">Select Category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select><br><br>

    <!-- NAME -->
    <label>Product Name</label><br>
    <input type="text" name="name" required><br><br>

    <!-- DESCRIPTION -->
    <label>Description</label><br>
    <textarea name="description"></textarea><br><br>

    <!-- MATERIAL -->
    <label>Material</label><br>
    <input type="text" name="material" placeholder="Gold, Silver, Diamond"><br><br>

    <!-- WEIGHT -->
    <label>Weight (grams)</label><br>
    <input type="number" step="0.01" name="weight"><br><br>

    <!-- PRICE -->
    <label>Price (Rs.)</label><br>
    <input type="number" step="0.01" name="price" required><br><br>

    <!-- DISCOUNT -->
    <label>Discount (%)</label><br>
    <input type="number" step="0.01" name="discount" value="0"><br><br>

    <!-- STOCK -->
    <label>Stock Quantity</label><br>
    <input type="number" name="stock_quantity" required><br><br>

    <!-- LOW STOCK -->
    <label>Low Stock Threshold</label><br>
    <input type="number" name="low_stock_threshold" value="5" required><br><br>

    <!-- IMAGE -->
    <label>Product Image</label><br>
    <input type="file" name="image"><br><br>

    <button type="submit">Save Product</button>
</form>

</body>
</html>