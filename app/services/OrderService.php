<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function createOrder($userId, array $data)
    {
        return DB::transaction(function () use ($userId, $data) {

            $cartItems = Cart::with('product')
                ->where('user_id', $userId)
                ->get();

            if ($cartItems->isEmpty()) {
                throw new \Exception('Your cart is empty.');
            }

            $total = 0;

            foreach ($cartItems as $item) {

                if (!$item->product) {
                    throw new \Exception('Product not found in cart.');
                }

                if ($item->quantity > $item->product->stock_quantity) {
                    throw new \Exception($item->product->name . ' does not have enough stock.');
                }

                $price = round((float) $item->product->price);
                $total += $price * (int) $item->quantity;
            }


            $order = Order::create([
                'user_id' => $userId,

                'full_name' => $data['full_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],

                'province' => $data['province'],
                'city' => $data['city'],
                'area' => $data['area'],
                'landmark' => $data['landmark'] ?? null,
                'delivery_address' => $data['delivery_address'],

                'payment_method' => $data['payment_method'],
                'payment_status' => 'pending',
                'order_status' => 'pending',

                'total_amount' => round($total, 2),
            ]);

            foreach ($cartItems as $item) {

                $price = round((float) $item->product->price);
                $subtotal = $price * (int) $item->quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price_at_purchase' => $price,
                    'subtotal' => $subtotal,
                ]);

                $item->product->decrement('stock_quantity', $item->quantity);
            }

            Cart::where('user_id', $userId)->delete();

            return $order;
        });
    }
}