<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\frontend\AccountController;
use App\Http\Controllers\Frontend\MainController;
use App\Http\Controllers\LoginController;
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



Route::group(
    ['as' => 'admin.', 'middleware' => ['auth', 'admin'], 'prefix' => 'admin'],
    function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('/disable', [AdminController::class, 'disableIdBy'])->name('disableIdBy');
        Route::get('profile', [AdminController::class, 'profile'])->name('profile');
        Route::post('profile', [AdminController::class, 'profileUpdate'])->name('profile.update');
        Route::get('/brand/create', function () {
            return view('admin.add-brand');
        })->name('add.brand');

        Route::post('/store-brand', [BrandController::class, 'store'])->name('store.brand');
        Route::delete('/brand/{id}', [BrandController::class, 'destroy'])->name('delete.brand');
        Route::get('/brand', [BrandController::class, 'editBrandPage'])->name('edit.brand.page');
        Route::get('/brand/list', [BrandController::class, 'list'])->name('brands.list');
        Route::get('/brand/edit/{id}', [BrandController::class, 'editBrand'])->name('edit.brand');
        Route::patch('/update-brand/{id}', [BrandController::class, 'updateBrand'])->name('update.brand');

        Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/category/list', [CategoryController::class, 'list'])->name('category.list');

        Route::get('/product', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/{id}', [ProductController::class, 'showProduct'])->name('products.show');
        Route::get('/product/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/product', [ProductController::class, 'store'])->name('product.store');
        Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/product/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
        Route::get('/product/manage/{id?}', [ProductController::class, 'manage'])->name('product.manage');
        Route::get('/product/list', [ProductController::class, 'list'])->name('product.list');
        Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

        Route::get('/product', [ProductController::class, 'index'])->name('products.index');

        Route::get('/order', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{status?}', [OrderController::class, 'orderStatus'])->name('orders_status');
        Route::get('/order/{id}', [OrderController::class, 'view'])->name('orders.view');
        Route::post('/order/status', [OrderController::class, 'status'])->name('orders.status');
        Route::post('/order/payment', [OrderController::class, 'payment'])->name('orders.payment');
        Route::get('/order/view/{id}', [OrderController::class, 'viewOrderDetails'])->name('orders.view_details');

        // For creating a new order
        Route::get('/orders/dispatch/create/{id?}', [OrderController::class, 'dispatchOrder'])->name('orders.dispatch.create');
        Route::post('/orders/dispatch', [OrderController::class, 'dispatchOrderStore'])->name('orders.dispatch.store');

        // For reading an existing order
        Route::get('/orders/dispatch/list', [OrderController::class, 'dispatchOrderList'])->name('orders.dispatch.index');
        // Route::get('/orders/dispatch/{id}', [OrderController::class, 'dispatchOrderShow'])->name('orders.dispatch.show');

        // // For editing an existing order
        Route::get('/orders/dispatch/{id}/edit', [OrderController::class, 'dispatchOrderEdit'])->name('orders.dispatch.edit');
        Route::put('/orders/dispatch/{id}', [OrderController::class, 'dispatchOrderUpdate'])->name('orders.dispatch.update');

        // // For deleting an existing order
        Route::delete('/orders/dispatch/{id}', [OrderController::class, 'dispatchOrderDestroy'])->name('orders.dispatch.destroy');

        // size routes
        Route::get('/size/create', [SizeController::class, 'create'])->name('size.create');
        Route::post('/size/store', [SizeController::class, 'store'])->name('size.store');
        Route::get('/size/list', [SizeController::class, 'list'])->name('size.list');
        Route::delete('/size/delete/{id}', [SizeController::class, 'delete'])->name('size.delete');
        Route::get('/size/edit/{id}', [SizeController::class, 'edit'])->name('size.edit');
        Route::put('/size/update/{id}', [SizeController::class, 'update'])->name('size.update');

        Route::get('/slider/create', [SliderController::class, 'create'])->name('sliders.create');
        Route::post('/slider', [SliderController::class, 'store'])->name('sliders.store');
        Route::get('/slider/edit/{id}', [SliderController::class, 'edit'])->name('sliders.edit');
        Route::put('/slider/{id}', [SliderController::class, 'update'])->name('sliders.update');
        Route::delete('/slider/{id}', [SliderController::class, 'destroy'])->name('sliders.destroy');
        Route::get('/slider/list', [SliderController::class, 'list'])->name('sliders.list');

        Route::get('/pending/discount', [ProductController::class, 'manageDiscounts'])->name('discounts.manage');
        Route::put('/discounts/{id}', [ProductController::class, 'updateDiscount'])->name('discounts.update');
        Route::get('/discount/edit/{product}', [ProductController::class, 'editDiscount'])->name('discounts.edit');
        Route::get('/discount/discounted-product/edit/{discount}', [ProductController::class, 'editDiscountedProduct'])->name('discount.discounted-product.edit');
        Route::put('/discount/discounted-product/update/{discount}', [ProductController::class, 'updateDiscountedProduct'])->name('discount.discounted-product.update');
        Route::post('/discount/products', [ProductController::class, 'discountOnProducts'])->name('discounts.product');
        Route::get('/discount/creatediscount', [ProductController::class, 'createDiscount'])->name('discount.creatediscount');
        Route::post('/discount/store', [ProductController::class, 'storeDiscount'])->name('discount.store');
        Route::get('/discounted-products', [ProductController::class, 'discountedProductList'])->name('discount.discounted_products');

    }
)->middleware('auth');
