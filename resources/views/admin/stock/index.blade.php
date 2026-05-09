<h1>Stock Management</h1>

<a href="{{ route('admin.dashboard') }}">Back</a>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif


<table border="1" cellpadding="10" width="100%">
<tr>
    <th>Product</th>
    <th>Category</th>
    <th>Stock</th>
    <th>Threshold</th>
    <th>Status</th>
    <th>Update</th>
</tr>

@foreach($products as $p)
<tr>
    <td>{{ $p->name }}</td>
    <td>{{ $p->category->name ?? '' }}</td>
    <td>{{ $p->stock_quantity }}</td>
    <td>{{ $p->low_stock_threshold }}</td>
    
     <form method="POST" action="{{ route('admin.stock.update', $p->id) }}">
        @csrf
        @method('PUT')

        <td>
            <input type="number" name="stock_quantity" value="{{ $p->stock_quantity }}" min="0">
        </td>

        <td>
            <input type="number" name="low_stock_threshold" value="{{ $p->low_stock_threshold }}" min="0">
        </td>
    <td>
        @if($p->stock_quantity == 0)
            <span style="color:red;">Out of Stock</span>
        @elseif($p->stock_quantity <= $p->low_stock_threshold)
            <span style="color:orange;">Low Stock</span>
        @else
            <span style="color:green;">In Stock</span>
        @endif
    </td>
     </td>

        <td>
            <button type="submit">Update</button>
        </td>
    </form>
</tr>
@endforeach


</table>