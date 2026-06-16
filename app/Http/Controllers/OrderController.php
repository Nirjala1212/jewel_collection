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
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $total = 0;

        foreach ($cartItems as $item) {
            $total += round((float) $item->product->price) * (int) $item->quantity;
        }

        return view('checkout.create', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $userId = auth()->id();

        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'province' => 'required|string',
            'city' => 'required|string',
            'area' => 'required|string',
            'landmark' => 'nullable|string|max:255',
            'delivery_address' => 'required|string',
            'payment_method' => 'required|string|in:COD,ESEWA',
        ]);

        try {
            $order = $this->orderService->createOrder($userId, $request->all());

            if ($request->payment_method === 'ESEWA') {
                return redirect()->route('esewa.pay', $order->id);
            }

            return redirect()
                ->route('orders.index')
                ->with('success', 'Order placed successfully. Cash on Delivery selected.');

        } catch (\Exception $e) {
            return redirect()
                ->route('checkout.create')
                ->with('error', $e->getMessage())
                ->withInput();
        }
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

    public function adminOrders()
    {
        $orders = Order::with('items.product', 'user')
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid,failed',
            'order_status' => 'required|in:pending,confirmed,processing,completed,cancelled',
        ]);

        $order->update([
            'payment_status' => $request->payment_status,
            'order_status' => $request->order_status,
            'status' => $request->order_status,
        ]);

        return back()->with('success', 'Order updated successfully.');
    }
}