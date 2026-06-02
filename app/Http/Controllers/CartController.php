<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        return view('user.cart', compact('cartItems'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock_quantity,
        ]);

        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + $request->quantity,
            ]);
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
        }

        if ($request->has('buy_now')) {
            return redirect()->route('checkout.create');
        }

        return redirect()->route('cart.index')
            ->with('success', 'Product added to cart successfully.');
    }

    public function remove($id)
    {
        Cart::where('user_id', auth()->id())
            ->where('id', $id)
            ->delete();

        return redirect()->route('cart.index')
            ->with('success', 'Product removed from cart.');
    }

    public function buyNow($id)
    {
        $product = Product::findOrFail($id);

        Cart::where('user_id', auth()->id())->delete();

        Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        return redirect()->route('checkout.create');
    }
}