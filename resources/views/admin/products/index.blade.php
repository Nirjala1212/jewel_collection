<h1>Products</h1>
<div style="margin-bottom:20px;">
    <a href="{{ route('user.dashboard') }}">← Back to Dashboard</a> |
    <a href="{{ route('cart.index') }}">View Cart</a>
</div><a href="{{ route('cart.index') }}">Go to Cart</a>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color:red;">{{ session('error') }}</p>
@endif

<div style="display:flex; flex-wrap:wrap; gap:20px;">

@foreach($products as $product)
    <div style="border:1px solid #ccc; padding:15px; width:220px;">

        @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" width="200">
        @endif

        <h3>{{ $product->name }}</h3>

        <p>Category: {{ $product->category->name ?? '' }}</p>

        <p>Price: Rs. {{ $product->price }}</p>

        <p>
            @if($product->stock_quantity == 0)
                <span style="color:red;">Out of Stock</span>
            @elseif($product->stock_quantity <= $product->low_stock_threshold)
                <span style="color:orange;">Low Stock</span>
            @else
                <span style="color:green;">In Stock</span>
            @endif
        </p>

        <form action="{{ route('cart.store', $product->id) }}" method="POST">
            @csrf
            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}">
            <br><br>
            <button type="submit">Add to Cart</button>
        </form>

    </div>
@endforeach

</div>