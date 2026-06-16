<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product', 'user')
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid,failed,refunded',
            'order_status' => 'required|in:pending,confirmed,processing,shipped,out_for_delivery,delivered,cancelled',
        ]);

        $order->update([
            'payment_status' => $request->payment_status,
            'order_status' => $request->order_status,
        ]);

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order updated successfully.');
    }
}