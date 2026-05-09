<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        return view('user.cart', compact('cart'));
    }

public function store(Request $request, Product $product)
{
    $request->validate([
        'quantity' => 'required|integer|min:1|max:' . $product->stock_quantity,
    ]);

    $cart = session()->get('cart', []);

    $quantity = (int) $request->quantity;

    $cart[$product->id] = [
        'id' => $product->id,
        'name' => $product->name,
        'price' => $product->price,
        'image' => $product->image,
        'quantity' => $quantity,
    ];

    session()->put('cart', $cart);

    return redirect()->route('cart.index')->with('success', 'Product added to cart successfully.');
}    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
    }
}