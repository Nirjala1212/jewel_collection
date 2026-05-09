<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <style>
        body {
            font-family: Arial;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background: #f4f4f4;
        }
        img {
            width: 80px;
        }
        .btn {
            padding: 8px 12px;
            background: green;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .checkout {
            margin-top: 20px;
            display: inline-block;
            background: blue;
        }
    </style>
</head>
<body>

<h1>Your Cart</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if($cartItems->count() > 0)

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Category</th>
            <th>Image</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>

    @php $grandTotal = 0; @endphp

    @foreach($cartItems as $item)

        @php
            $total = $item->product->price * $item->quantity;
            $grandTotal += $total;
        @endphp

        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->product->category->name }}</td>
            <td>
                <img src="{{ $item->product->image }}" alt="image">
            </td>
            <td>${{ $item->product->price }}</td>
            <td>{{ $item->quantity }}</td>
            <td>${{ $total }}</td>
        </tr>

    @endforeach

    </tbody>
</table>

<h3>Grand Total: ${{ $grandTotal }}</h3>

<a href="/checkout" class="btn checkout">Proceed to Checkout</a>

@else

<p>Your cart is empty.</p>

@endif

<br><br>
<a href="/products">← Continue Shopping</a>

</body>
</html>