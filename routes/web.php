<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\EsewaController;

//home
Route::get('/', [ProductController::class, 'landing'])->name('landing');
Route::get('/jewel_collection', [ProductController::class, 'landing'])->name('jewel.collection');
// AUTH
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ADMIN ROUTES
Route::middleware(['role:admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        $lowStockProducts = \App\Models\Product::whereColumn('stock_quantity', '<=', 'low_stock_threshold')->get();
        $outOfStockProducts = \App\Models\Product::where('stock_quantity', 0)->get();

        return view('admin.dashboard', compact('lowStockProducts', 'outOfStockProducts'));
    })->name('admin.dashboard');

    Route::resource('/admin/categories', CategoryController::class)->names('admin.categories');

    Route::resource('/admin/products', \App\Http\Controllers\Admin\ProductController::class)
        ->names('admin.products');

Route::get('/admin/stock', [ProductController::class, 'stock'])->name('admin.stock');

Route::put('/admin/stock/{product}', [ProductController::class, 'updateStock'])
    ->name('admin.stock.update');Route::get('/admin/reviews', [\App\Http\Controllers\Admin\ReviewController::class, 'index'])
    ->name('admin.reviews');
     Route::get('/admin/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])
    ->name('admin.orders.index');
    Route::patch('/admin/orders/{order}/update-status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])
    ->name('admin.orders.updateStatus');
    });

// USER ROUTES
Route::middleware(['role:user'])->group(function () {

    Route::get('/user/dashboard', function () {
        $products = \App\Models\Product::with('category')
            ->where('stock_quantity', '>', 0)
            ->latest()
            ->take(6)
            ->get();

        $categories = \App\Models\Category::latest()->get();

        return view('user.dashboard', compact('products', 'categories'));
    })->name('user.dashboard');

    Route::get('/user/category/{id}/products', function ($id) {
        $category = \App\Models\Category::findOrFail($id);

        $products = \App\Models\Product::where('category_id', $id)
            ->where('stock_quantity', '>', 0)
            ->latest()
            ->get();

        return view('user.category-products', compact('category', 'products'));
    })->name('category.products');

    Route::post('/cart/add/{product}', [CartController::class, 'store'])->name('cart.store');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/buy-now/{id}', [CartController::class, 'buyNow'])->name('buy.now');
    Route::get('/checkout', [OrderController::class, 'create'])->name('checkout.create');
    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

Route::post('/product/{product}/review', [ReviewController::class, 'store'])
    ->name('reviews.store');
});// PUBLIC PRODUCT ROUTES
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
// ESEWA PAYMENT ROUTES
Route::get('/esewa/pay/{orderId}', [EsewaController::class, 'pay'])
    ->name('esewa.pay');

Route::get('/esewa/success', [EsewaController::class, 'success'])
    ->name('esewa.success');

Route::get('/esewa/failure', [EsewaController::class, 'failure'])
    ->name('esewa.failure');