<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

// HOME
Route::get('/', function () {
    return redirect()->route('login');
});

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

    Route::get('/admin/stock', [\App\Http\Controllers\Admin\ProductController::class, 'stock'])
        ->name('admin.stock');

    Route::put('/admin/stock/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'updateStock'])
        ->name('admin.stock.update');
});

// USER ROUTES
Route::middleware(['role:user'])->group(function () {

    Route::get('/user/dashboard', function () {
        $products = \App\Models\Product::with('category')
            ->where('stock_quantity', '>', 0)
            ->latest()
            ->take(6)
            ->get();

        return view('user.dashboard', compact('products'));
    })->name('user.dashboard');

    Route::post('/cart/add/{product}', [CartController::class, 'store'])->name('cart.store');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/checkout', [OrderController::class, 'create'])->name('checkout.create');
    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});
// PUBLIC PRODUCT ROUTES
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');