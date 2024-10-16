<?php

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
// Admin Routes
Route::group(['middleware' => 'guest:admin', 'prefix' => 'admin'], function () {
    Route::get('/login', [\App\Http\Controllers\Admin\AdminController::class, 'loginForm'])->name('admin.login');
    Route::post('/login/store', [\App\Http\Controllers\Admin\AdminController::class, 'login'])->name('login.store');
    Route::get('/register', [\App\Http\Controllers\Admin\AdminController::class, 'registerForm'])->name('admin.register');
    Route::post('/register/store', [\App\Http\Controllers\Admin\AdminController::class, 'register'])->name('register');
});

Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin'], function () {
    Route::get('/category', [\App\Http\Controllers\CategoryController::class, 'index'])->name('category');
    Route::get('/category/create', [\App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [\App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [\App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/update/{id}', [\App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [\App\Http\Controllers\CategoryController::class, 'destroy'])->name('category.delete');


    Route::get('/product', [\App\Http\Controllers\ProductController::class, 'index'])->name('admin.product');
    Route::get('/product/create', [\App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [\App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [\App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{id}', [\App\Http\Controllers\ProductController::class, 'update']);
    Route::delete('/product/{id}', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('product.delete');


    Route::get('/order', [\App\Http\Controllers\OrderController::class, 'index'])->name('order');
    Route::get('/order/create', [\App\Http\Controllers\OrderController::class, 'create'])->name('order.create');
    Route::post('/order/store', [\App\Http\Controllers\OrderController::class, 'store'])->name('order.store');
    Route::get('/order/edit/{id}', [\App\Http\Controllers\OrderController::class, 'edit'])->name('order.edit');
    Route::post('/order/update/{id}', [\App\Http\Controllers\OrderController::class, 'update']);
    Route::delete('/order/{id}', [\App\Http\Controllers\OrderController::class, 'destroy'])->name('order.delete');


    Route::get('/brand', [\App\Http\Controllers\BrandController::class, 'index'])->name('brand');
    Route::get('/brand/create', [\App\Http\Controllers\BrandController::class, 'create'])->name('brand.create');
    Route::post('/brand/store', [\App\Http\Controllers\BrandController::class, 'store'])->name('brand.store');
    Route::get('/brand/edit/{id}', [\App\Http\Controllers\BrandController::class, 'edit'])->name('brand.edit');
    Route::put('/brand/update/{id}', [\App\Http\Controllers\BrandController::class, 'update'])->name('brand.update');
    Route::delete('/brand/{id}', [\App\Http\Controllers\BrandController::class, 'destroy'])->name('brand.delete');

    Route::post('/logout', [\App\Http\Controllers\Admin\AdminController::class, 'logout'])->name('logout');

});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [\App\Http\Controllers\UserController::class, 'loginForm'])->name('user.login');
    Route::post('/login/store', [\App\Http\Controllers\UserController::class, 'login'])->name('user.login.store');
    Route::get('/register', [\App\Http\Controllers\UserController::class, 'registerForm'])->name('user.register');
    Route::post('/register/store', [\App\Http\Controllers\UserController::class, 'register'])->name('register.user');

});
Route::group(['middleware' => 'auth'], function () {
Route::post('/cart/add', [\App\Http\Controllers\Frontend\ProductController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [\App\Http\Controllers\Frontend\ProductController::class, 'viewCart'])->name('cart.view');
Route::delete('/cart/{id}', [\App\Http\Controllers\Frontend\ProductController::class, 'destroy'])->name('cart.delete');
Route::post('/checkout/store', [\App\Http\Controllers\Frontend\ProductController::class, 'checkout'])->name('checkout');
Route::post('/cart/update/{id}', [\App\Http\Controllers\Frontend\ProductController::class, 'updateCart'])->name('cart.update');
Route::get('/cart/thank-you', [\App\Http\Controllers\Frontend\ProductController::class, 'ThankYou'])->name('cart.thank-you');
Route::get('/order/order-details/{id}', [\App\Http\Controllers\OrderController::class, 'show'])->name('order.detail');
    Route::post('/logout/front', [\App\Http\Controllers\UserController::class, 'logout'])->name('logout.user');

});
Route::get('/product/detail/{id}', [\App\Http\Controllers\Frontend\ProductController::class, 'show'])->name('product.detail');
Route::get('/product', [\App\Http\Controllers\Frontend\ProductController::class, 'index'])->name('product.index');




Route::get('/products/category/{category}', [\App\Http\Controllers\Frontend\ProductController::class, 'showByCategory'])->name('products.byCategory');
Route::get('/products/brand/{brand}', [\App\Http\Controllers\Frontend\ProductController::class, 'showByBrand'])->name('products.byBrand');






