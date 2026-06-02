<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->where('stock_quantity', '>', 0)
            ->latest()
            ->get();

        return view('user.products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        $reviews = Review::with('user')
            ->where('product_id', $id)
            ->latest()
            ->get();

        return view('user.product-details', compact('product', 'reviews'));
    }

    public function landing()
    {
        $products = Product::latest()->get();
        $categories = Category::latest()->get();

        return view('user.dashboard', compact('products', 'categories'));
    }

    public function stock()
    {
        $products = Product::with('category')
            ->latest()
            ->get();

        return view('admin.stock', compact('products'));
    }

    public function updateStock(Request $request, Product $product)
    {
        $request->validate([
            'stock_quantity' => 'required|integer|min:0',
            'low_stock_threshold' => 'required|integer|min:0',
        ]);

        $product->update([
            'stock_quantity' => $request->stock_quantity,
            'low_stock_threshold' => $request->low_stock_threshold,
        ]);

        return redirect()->route('admin.stock')->with('success', 'Stock updated successfully.');
    }
}