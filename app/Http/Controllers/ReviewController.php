<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reviews', 'public');
        }

Review::create([
    'user_id' => auth()->id(),
    'product_id' => $productId,
    'rating' => $request->rating,
    'comment' => $request->comment,
    'image' => $imagePath,
]);
        return back()->with('success', 'Review submitted successfully.');
    }
    public function index()
{
    $reviews = \App\Models\Review::with(['user', 'product'])->latest()->get();

    return view('admin.reviews.index', compact('reviews'));
}
}