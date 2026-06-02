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

    public function create()
    {
        $userId = auth()->id();

        $cartItems = Cart::with('product.category')
            ->where('user_id', $userId)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item->product->final_price * $item->quantity;
        }

        return view('checkout.create', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $userId = auth()->id();

        $request->validate([
            'delivery_address' => 'required|string',
            'payment_method' => 'required|string|in:COD,ESEWA',
        ]);

        $order = $this->orderService->createOrder($userId, $request->all());

        if ($request->payment_method == 'COD') {
            return redirect()
                ->route('orders.index')
                ->with('success', 'Order placed successfully with Cash on Delivery.');
        }

        if ($request->payment_method == 'ESEWA') {
            return redirect()
                ->route('orders.index')
                ->with('success', 'eSewa payment integration coming soon.');
        }

        return redirect()->route('orders.index');
    }

    public function index()
    {
        $userId = auth()->id();

        $orders = Order::with('items.product')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }
}