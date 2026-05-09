<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | Jewel Collection</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6f9;
            color: #333;
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #1f2937;
            color: white;
            padding: 25px 20px;
        }

        .sidebar h2 {
            margin-bottom: 35px;
            font-size: 24px;
            color: #facc15;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 13px 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .sidebar a:hover,
        .sidebar .active {
            background: #374151;
            color: #facc15;
        }

        .main {
            flex: 1;
            padding: 25px;
        }

        .topbar {
            background: white;
            padding: 18px 25px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .topbar h1 {
            font-size: 26px;
        }

        .logout-btn {
            background: #dc2626;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #b91c1c;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 14px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .card h3 {
            font-size: 15px;
            color: #666;
            margin-bottom: 12px;
        }

        .card p {
            font-size: 28px;
            font-weight: bold;
            color: #111827;
        }

        .section {
            background: white;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .section h2 {
            margin-bottom: 15px;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .action-box {
            background: #f9fafb;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
        }

        .action-box h3 {
            margin-bottom: 8px;
            color: #111827;
        }

        .action-box p {
            color: #666;
            font-size: 14px;
        }

        @media (max-width: 900px) {
            .cards,
            .quick-actions {
                grid-template-columns: 1fr;
            }

            .dashboard {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="dashboard">

    <aside class="sidebar">
        <h2>Jewel Admin</h2>

        <a href="{{ route('admin.dashboard') }}" class="active">Dashboard</a>
        <a href="{{ route('admin.categories.index') }}">Manage Categories</a>
        <a href="{{ route('admin.products.index') }}">Manage Products</a>       
        <a href="{{ route('admin.stock') }}">Stock Management</a>
        <a href="#">Manage Orders</a>
        <a href="#">Payments</a>
        <a href="#">Reviews</a>
        <a href="#">Customers</a>
    </aside>

    <main class="main">

        <div class="topbar">
            <div>
                <h1>Admin Dashboard</h1>
                <p>Welcome, {{ Auth::user()->full_name }}</p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn" type="submit">Logout</button>
            </form>
        </div>

        <div class="cards">
            <div class="card">
                <h3>Total Products</h3>
                <p>0</p>
            </div>

            <div class="card">
                <h3>Total Orders</h3>
                <p>0</p>
            </div>

            <div class="card">
                <h3>Total Customers</h3>
                <p>0</p>
            </div>

            <div class="card">
                <h3>Total Revenue</h3>
                <p>Rs. 0</p>
            </div>
        </div>

        <div class="section">
            <h2>Quick Management</h2>

            <div class="quick-actions">
                <div class="action-box">
                    <h3>Categories</h3>
                    <p>Add and manage jewelry categories like rings, earrings, necklaces.</p>
                </div>

                <div class="action-box">
                    <h3>Products</h3>
                    <p>Add jewelry products with price, image, stock and details.</p>
                </div>

                <div class="action-box">
                    <h3>Orders</h3>
                    <p>View customer orders, payment status and delivery progress.</p>
                </div>
            </div>
        </div>
         <div class="section" style="margin-top:25px;">
    <h2>Stock Alerts</h2>

    <p>
        Low Stock Products: 
        <strong style="color:orange;">{{ $lowStockProducts->count() }}</strong>
    </p>

    <p>
        Out of Stock Products: 
        <strong style="color:red;">{{ $outOfStockProducts->count() }}</strong>
    </p>

    @if($lowStockProducts->count() > 0)
        <h3>Low Stock List</h3>
        <ul>
            @foreach($lowStockProducts as $product)
                <li>
                    {{ $product->name }} —
                    Stock: {{ $product->stock_quantity }},
                    Threshold: {{ $product->low_stock_threshold }}
                </li>
            @endforeach
        </ul>
    @endif
</div>
    </main>

</div>

</body>
</html>