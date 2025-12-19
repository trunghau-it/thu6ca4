<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Middleware\IsAdmin;
// route home
Route::get('/', [HomeController::class, 'index'])->name('home');

// routes đăng nhập, đăng ký, đăng xuất
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
// route sản phẩm


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
// route chi tiết sản phẩm


Route::get('/products/{slug}', [ProductController::class, 'show'])
    ->name('products.show');

Route::post('/cart/add', [CartController::class, 'add'])
    ->name('cart.add');
// route giỏ hàng

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

//checkout đặt hàng
Route::get('/checkout', [CheckoutController::class, 'index'])
    ->middleware('auth')
    ->name('checkout');

Route::post('/checkout', [CheckoutController::class, 'store'])
    ->middleware('auth');

Route::get('/checkout/success', [CheckoutController::class, 'success'])
    ->middleware('auth');

Route::get('/orders', [OrderController::class, 'index'])
    ->middleware('auth')
    ->name('orders.index');
// route chi tiết đơn hàng
Route::get('/orders/{id}', [OrderController::class, 'show'])
    ->middleware('auth')
    ->name('orders.show');

//Admin routes (dùng nhóm route và tiền tố "admin")
Route::middleware(['auth', 'is_admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');
});


// Dashboard admin
Route::middleware(['auth', IsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

    });
// Quản lý danh mục

Route::middleware(['auth', IsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('categories', CategoryController::class);
    });
//Quản lý sản phẩm
Route::middleware(['auth', IsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/products', [AdminProductController::class, 'index'])
            ->name('products.index');

        Route::get('/products/create', [AdminProductController::class, 'create'])
            ->name('products.create');

        Route::post('/products', [AdminProductController::class, 'store'])
            ->name('products.store');

        Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])
            ->name('products.edit');

        Route::put('/products/{product}', [AdminProductController::class, 'update'])
            ->name('products.update');

        Route::patch('/products/{product}/toggle', [AdminProductController::class, 'toggle'])
            ->name('products.toggle');
    });

//order

Route::middleware(['auth', IsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('orders', [AdminOrderController::class, 'index'])
            ->name('orders.index');

        Route::get('orders/{order}', [AdminOrderController::class, 'show'])
            ->name('orders.show');

        Route::put('orders/{order}', [AdminOrderController::class, 'update'])
            ->name('orders.update');

        Route::delete('orders/{order}', [AdminOrderController::class, 'destroy'])
            ->name('orders.destroy');
    });





//report

Route::middleware(['auth', IsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('reports', [AdminReportController::class, 'index'])
            ->name('reports.index');

        Route::get('reports/pdf', [AdminReportController::class, 'exportPdf'])
            ->name('reports.pdf');
    });
