<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\backend\ConfigurationController;
use App\Http\Controllers\backend\CustomerController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\frontend\ShoppingController;
use App\Http\Controllers\frontend\TransactionController;
use App\Models\Categories;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/details/{id}', [HomeController::class, 'details'])->name('details');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/shop/categories/{slug}', [HomeController::class, 'categories'])->name('categories');

Route::middleware(['auth', 'verified', 'role:customer'])->group(function () {
    Route::get('/wishlist', [ShoppingController::class, 'wishlist'])->name('wishlist');
    Route::post('/wishlist/store', [ShoppingController::class, 'store'])->name('wishlist.store');
    Route::get('/wishlist/delete/{id}', [ShoppingController::class, 'delete'])->name('wishlist.delete');

    Route::get('/carts', [ShoppingController::class, 'carts'])->name('carts');
    Route::post('/carts/store', [ShoppingController::class, 'carts_store'])->name('carts.store');
    Route::post('/carts/update', [ShoppingController::class, 'carts_update'])->name('carts.update');
    Route::get('/carts/delete/{id}', [ShoppingController::class, 'delete_carts'])->name('carts.delete');
    Route::post('/checkout', [TransactionController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/payMidtrans', [TransactionController::class, 'payMidtrans'])->name('checkout.payMidtrans');

    Route::get('/order', [TransactionController::class, 'order'])->name('order');
    Route::get('/orderDetail/{id}', [TransactionController::class, 'orderDetail'])->name('order.detail');
    Route::post('/orderCancel/{id}', [TransactionController::class, 'orderCancel'])->name('order.cancel');
    Route::get('/order/update/{id}', [TransactionController::class, 'orderUpdate'])->name('order.update');
    Route::post('/order/pendingPay', [TransactionController::class, 'pendingPay'])->name('order.pendingPay');
    Route::post('/order/pendingUpdate', [TransactionController::class, 'pendingUpdate'])->name('order.pendingUpdate');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/configuration', [ConfigurationController::class, 'index'])->name('admin.configuration');
    Route::post('/admin/configuration/formIcon', [ConfigurationController::class, 'formIcon'])->name('admin.formicon');
    Route::post('/admin/configuration/formStore', [ConfigurationController::class, 'formStore'])->name('admin.formstore');
    Route::post('/admin/configuration/iconStore/{id}', [ConfigurationController::class, 'iconStore'])->name('admin.iconstore');

    Route::get('/admin/customer', CustomerController::class)->name('admin.customer');

    Route::get('/admin/order', [OrderController::class, 'index'])->name('admin.order');
    Route::post('/admin/formOrder', [OrderController::class, 'formOrder'])->name('admin.formorder');
    Route::post('/admin/orderStore', [OrderController::class, 'orderStore'])->name('admin.orderstore');

    Route::get('/admin/categories', [ProductController::class, 'categories'])->name('admin.categories');
    Route::post('/admin/formCategories', [ProductController::class, 'formCategories'])->name('admin.formcategories');
    Route::post('/admin/actionCategories', [ProductController::class, 'actionCategories'])->name('admin.actioncategories');
    Route::post('/admin/deleteCategories/{id}', [ProductController::class, 'deleteCategories'])->name('admin.deletecategories');

    Route::get('/admin/product', [ProductController::class, 'product'])->name('admin.product');
    Route::post('/admin/formProduct', [ProductController::class, 'formProduct'])->name('admin.formproduct');
    Route::post('/admin/actionProduct', [ProductController::class, 'actionProduct'])->name('admin.actionproduct');
    Route::post('/admin/deleteProduct/{id}', [ProductController::class, 'deleteProduct'])->name('admin.deleteproduct');
});

Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProvideCallback']);

require __DIR__ . '/auth.php';
