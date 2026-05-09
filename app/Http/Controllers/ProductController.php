<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'material' => 'nullable|string|max:100',
            'weight' => 'nullable|numeric',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'stock_quantity' => 'required|integer',
            'image' => 'nullable|string|max:255',
        ]);

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'material' => $request->material,
            'weight' => $request->weight,
            'price' => $request->price,
            'discount' => $request->discount ?? 0,
            'stock_quantity' => $request->stock_quantity,
            'image' => $request->image,
        ]);

        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }
public function show($id)
{
    $product = Product::with('category')->findOrFail($id);

    $reviews = collect(); // temporary until review table/model is ready

    return view('user.product-details', compact('product', 'reviews'));
}}