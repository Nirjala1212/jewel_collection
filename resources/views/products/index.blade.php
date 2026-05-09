<!DOCTYPE html>
<html>
<head>
    <title>Products List</title>
</head>
<body>

<h1>All Products</h1>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<a href="{{ route('products.create') }}">Add New Product</a>

<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Category</th>
        <th>Name</th>
        <th>Material</th>
        <th>Price</th>
        <th>Discount</th>
        <th>Final Price</th>
        <th>Stock</th>
        <th>Image</th>
    </tr>

    @forelse($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->category->name ?? 'N/A' }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->material }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->discount }}</td>
            <td>{{ $product->final_price }}</td>
            <td>{{ $product->stock_quantity }}</td>
            <td>{{ $product->image }}</td>
            
        </tr>
    @empty
        <tr>
            <td colspan="8">No products found.</td>
        </tr>
    @endforelse
</table>

</body>
</html>