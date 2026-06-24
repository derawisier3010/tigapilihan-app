<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
LOGIN PAGE 
*/

Route::get('/', function () {
    return view('welcome');
});

/*
DASHBOARD
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

/*
PROFILE
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
PRODUCTS
*/

Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
});

/*
CART
*/

Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
Route::get('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');

/*
CHECKOUT
*/

Route::middleware('auth')->group(function () {

    Route::match(['get', 'post'], '/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout/process', [CheckoutController::class, 'process'])
        ->name('checkout.process');

});

/*
ADMIN (PROTECTED)
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.index');

    Route::get('/admin/update/{id}', [AdminController::class, 'updateStatus'])
        ->name('admin.update');

    Route::get('/admin/users', [AdminController::class, 'users'])
        ->name('admin.users');

    Route::get('/admin/user-role/{id}', [AdminController::class, 'changeRole'])
        ->name('admin.role');

    Route::delete('/admin/user-delete/{id}', [AdminController::class, 'deleteUser'])
        ->name('admin.user.delete');
});


Route::get('/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

Route::middleware('auth')->group(function () {

    Route::get('/pesanan', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/pesanan/{id}', [OrderController::class, 'show'])
        ->name('orders.show');

});

Route::get('/admin/users', [AdminController::class, 'users'])
    ->name('admin.users');


require __DIR__.'/auth.php';

/*
REGISTER
*/
Route::get('/register', function () {
    return view('register');
})->name('register');
