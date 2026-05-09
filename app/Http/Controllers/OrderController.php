<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    // Show checkout page
    public function create()
    {
        $userId = 1; // temporary

        $cartItems = Cart::with('product.category')
            ->where('user_id', $userId)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('success', 'Your cart is empty.');
        }

        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item->product->final_price * $item->quantity;
        }

        return view('checkout.create', compact('cartItems', 'total'));
    }

    // Place order
    public function store(Request $request)
    {
        $userId = 1; // temporary

        $request->validate([
            'delivery_address' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $this->orderService->createOrder($userId, $request->all());

        return redirect()->route('orders.index')
            ->with('success', 'Order placed successfully.');
    }

    // Show all orders
    public function index()
    {
        $userId = 1;

        $orders = Order::with('items.product')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }
}