<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function createOrder($userId, $data)
    {
        return DB::transaction(function () use ($userId, $data) {

            $cartItems = Cart::with('product')->where('user_id', $userId)->get();

            if ($cartItems->isEmpty()) {
                throw new \Exception('Your cart is empty.');
            }

            foreach ($cartItems as $item) {
                if ($item->product->stock_quantity < $item->quantity) {
                    throw new \Exception($item->product->name . ' does not have enough stock.');
                }
            }

            $total = 0;

            foreach ($cartItems as $item) {
                $total += $item->product->final_price * $item->quantity;
            }

            $order = Order::create([
                'user_id' => $userId,
                'total_amount' => $total,
                'payment_method' => $data['payment_method'],
                'payment_status' => 'pending',
                'order_status' => 'pending',
                'delivery_address' => $data['delivery_address'],
            ]);

            foreach ($cartItems as $item) {
                $price = $item->product->final_price;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price_at_purchase' => $price,
                    'subtotal' => $price * $item->quantity,
                ]);

                $item->product->decrement('stock_quantity', $item->quantity);
            }

            Cart::where('user_id', $userId)->delete();

            return $order;
        });
    }
}