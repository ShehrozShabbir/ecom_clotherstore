<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\MainController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SizeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/shop', [MainController::class, 'shop'])->name('shop');
Route::get('/shop-details/{prod_name}/{prod_id}', [MainController::class, 'shopDetails'])->name('shop.details');
Route::get('/blog', [MainController::class, 'blog'])->name('blog');
Route::get('/blog-details', [MainController::class, 'blogDetails'])->name('blog.details');
Route::get('/about', [MainController::class, 'about'])->name('about');
Route::get('/checkout', [MainController::class, 'checkout'])->name('checkout');

Route::get('/contact', [MainController::class, 'contact'])->name('contact');
Route::get('/about', [MainController::class, 'about'])->name('about');
Route::get('/shopping-cart', [MainController::class, 'cart'])->name('cart');
Route::get('/accessoires', [MainController::class, 'cart'])->name('accessoires');

Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout.post');
Route::post('/cart', [CartController::class, 'addBooktoCart'])->name('add.cart');
Route::patch('/update-cart', [CartController::class, 'updateCart'])->name('update.cart');
Route::delete('/delete-cart', [CartController::class, 'deleteProduct'])->name('delete.cart');
Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('clear.cart');

Route::get('login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('loginPost', [LoginController::class, 'authenticate'])->name('loginPost');
Route::get('reset-password/{key}', [LoginController::class, 'resetPassword'])->name('reset.password');
Route::post('reset-password', [LoginController::class, 'resetPasswordCh'])->name('reset.password.post');



Route::group(['as' => 'admin.','middleware'=>'auth'], function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('admin/disable', [AdminController::class, 'disableIdBy'])->name('disableIdBy');
    Route::get('profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('profile', [AdminController::class, 'profileUpdate'])->name('profile.update');
    Route::get('/dashboard/add-brand', function () {
        return view('admin.add-brand');
    })->name('add.brand');

    Route::post('/dashboard/store-brand', [BrandController::class, 'store'])->name('store.brand');
    Route::delete('/brands/{id}', [BrandController::class, 'destroy'])->name('delete.brand');
    Route::get('/dashboard/edit-brand', [BrandController::class, 'editBrandPage'])->name('edit.brand.page');

    Route::get('/dashboard/update-brand/{id}', [BrandController::class, 'editBrand'])->name('edit.brand');
    Route::patch('/dashboard/update-brand/{id}', [BrandController::class, 'updateBrand'])->name('update.brand');

    Route::get('/category', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/category/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/categories/list', [CategoryController::class, 'list'])->name('category.list');

    Route::get('/dashboard/brands', [BrandController::class, 'list'])->name('brands.list');
    Route::get('/category', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/category/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/categories/list', [CategoryController::class, 'list'])->name('category.list');


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('product.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/admin/products/manage/{id?}', [ProductController::class, 'manage'])->name('product.manage');
    Route::get('products', [ProductController::class, 'list'])->name('product.list');
    Route::delete('admin/products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/admin/order/{id}', [OrderController::class, 'view'])->name('orders.view');
    Route::post('/admin/orders/status', [OrderController::class, 'status'])->name('orders.status');
    Route::post('/admin/orders/payment', [OrderController::class, 'payment'])->name('orders.payment');

    // size routes
    Route::get('/admin/size/create', [SizeController::class, 'create'])->name('size.create');
    Route::post('/admin/size/store', [SizeController::class, 'store'])->name('size.store');
    Route::get('/admin/size/list', [SizeController::class, 'list'])->name('size.list');
    Route::delete('/admin/size/delete/{id}', [SizeController::class, 'delete'])->name('size.delete');
    Route::get('/admin/size/edit/{id}', [SizeController::class, 'edit'])->name('size.edit');
    Route::put('/admin/size/update/{id}', [SizeController::class, 'update'])->name('size.update');
}
)->middleware('auth');
