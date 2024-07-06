<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Client\CarouselController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\SaleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Client\AddressController;
use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\OrderItemController;
use App\Http\Controllers\Client\WishListController;

/*
 ** Auth Route Working
 */
Route::get('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/user/register', [AuthController::class, 'userRegister']);
Route::post('/user/login', [AuthController::class, 'userLogin']);
// Home Route
Route::get('/', [HomeController::class, 'index']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    /**
     * Profile Route
     */
    Route::get('/profile/{profileId}', [ProfileController::class, 'profileData']);
    Route::delete('/profile/delete/{profileId}', [ProfileController::class, 'profileDelete']);

    Route::get('/profile/edit/{profileId}', [ProfileController::class, 'profileEdit']);
    Route::put('/profile/update/{profileId}', [ProfileController::class, 'profileUpdate']);

    /*
     ** Address Route
     */
    Route::get('/address', [AddressController::class, 'index']);
    Route::get('/create/address/form', [AddressController::class, 'create']);
    Route::post('/store/address', [AddressController::class, 'store']);
    Route::get('/show/address/{addressId}', [AddressController::class, 'show']);
    Route::get('/edit/address/{addressId}', [AddressController::class, 'edit']);
    Route::put('/update/address/{addressId}', [AddressController::class, 'update']);
    Route::delete('/delete/address/{addressId}', [AddressController::class, 'destroy']);

    /*
     ** Category Route
     */
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/create/category/form', [CategoryController::class, 'create']);
    Route::post('/store/category', [CategoryController::class, 'store']);
    Route::get('/show/category/{categoryId}', [CategoryController::class, 'show']);
    Route::get('/edit/category/{categoryId}', [CategoryController::class, 'edit']);
    Route::put('/update/category/{categoryId}', [CategoryController::class, 'update']);
    Route::delete('/delete/category/{categoryId}', [CategoryController::class, 'destroy']);

    /*
     ** Product Route
     */
    Route::get('/create/product/form', [ProductController::class, 'create']);
    Route::post('/store/product', [ProductController::class, 'store']);
    Route::get('/show/product/{productId}', [ProductController::class, 'show']);
    Route::get('/edit/product/{productId}', [ProductController::class, 'edit']);
    Route::put('/update/product/{productId}', [ProductController::class, 'update']);
    Route::delete('/delete/product/{productId}', [ProductController::class, 'destroy']);
    Route::get('/category/one/{categoryId}', [ProductController::class, 'oneCategoryProduct']);

    /*
     ** Cart Route
     */
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/add/cart/{productId}', [CartController::class, 'addCart']);
    Route::put('/update/cart/{cartId}', [CartController::class, 'quantityUpdate']);
    Route::get('/delete/cart/{cartId}', [CartController::class, 'removeProduct']);

    /*
     ** Order Route
     */
    Route::get('/order', [OrderController::class, 'index']);
    Route::get('/create/order/form', [OrderController::class, 'create']);
    Route::post('/store/order', [OrderController::class, 'store']);
    Route::get('/show/order/{orderId}', [OrderController::class, 'show']);
    Route::get('/edit/order/{orderId}', [OrderController::class, 'edit']);
    Route::put('/update/order/{orderId}', [OrderController::class, 'update']);
    Route::delete('/delete/order/{orderId}', [OrderController::class, 'destroy']);

    /*
     ** Order Item Route
     */
    Route::get('/orderItem', [OrderItemController::class, 'index']);
    Route::get('/create/orderItem/form', [OrderItemController::class, 'create']);
    Route::post('/store/orderItem', [OrderItemController::class, 'store']);
    Route::get('/show/orderItem/{orderItemId}', [OrderItemController::class, 'show']);
    Route::get('/edit/orderItem/form', [OrderItemController::class, 'edit']);
    Route::put('/update/orderItem/{orderItemId}', [OrderItemController::class, 'update']);
    Route::delete('/delete/orderItem/{orderItemId}', [OrderItemController::class, 'destroy']);

    /*
     ** Sale Route
     */
    Route::get('/sale', [SaleController::class, 'index']);
    Route::get('/create/sale/form', [SaleController::class, 'create']);
    Route::post('/store/sale', [SaleController::class, 'store']);
    Route::get('/show/sale/{saleId}', [SaleController::class, 'show']);
    Route::get('/edit/sale/{saleId}', [SaleController::class, 'edit']);
    Route::put('/update/sale/{saleId}', [SaleController::class, 'update']);
    Route::delete('/delete/sale/{saleId}', [SaleController::class, 'destroy']);

    /*
     ** Carousel Route
     */
    Route::get('/carousel', [CarouselController::class, 'index']);
    Route::get('/create/carousel/form', [CarouselController::class, 'create']);
    Route::post('/store/carousel', [CarouselController::class, 'store']);
    Route::get('/show/carousel/{carouselId}', [CarouselController::class, 'show']);
    Route::get('/edit/carousel/{carouselId}', [CarouselController::class, 'edit']);
    Route::put('/update/carousel/{carouselId}', [CarouselController::class, 'update']);
    Route::delete('/delete/carousel/{carouselId}', [CarouselController::class, 'destroy']);

    /*
     ** Checkout Route
     */
    Route::get('/paymentType', [CheckoutController::class, 'paymentType'])->middleware('auth');
    Route::get('/checkout', [CheckoutController::class, 'index'])->middleware('auth');
    Route::get('/order/successfully', [CheckoutController::class, 'success']); // To show the Successfull Order Message
    Route::post('/store/order/checkout', [CheckoutController::class, 'store'])->middleware('auth');
    Route::put('/order/update/{orderId}', [CheckoutController::class, 'update'])->middleware('auth');
    Route::delete('/order/cancel/{orderId}', [CheckoutController::class, 'destroy'])->middleware('auth');

    // Wishlist Routes
    Route::get('/wishlist', [WishListController::class, 'index'])->name('wishlist');
    Route::post('/wishlist/add', [WishListController::class, 'store'])->name('wishlist.add');
    Route::delete('/wishlist/delete/{wishlistId}', [WishListController::class, 'destroy'])->name('wishlist.delete');

});

Route::group(['middleware' => 'admin.guest'], function () {
    // Admin Auth Route
    Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');
    Route::get('/admin/register', [AdminController::class, 'adminRegister'])->name('admin.register');
    Route::post('/admin/post/login', [AdminController::class, 'loginPostAdmin'])->name('admin.post.login');
    Route::post('/admin/post/register', [AdminController::class, 'registerPostAdmin'])->name('admin.post.register');
});

Route::group(['middleware' => 'admin.auth'], function () {
    // Admin Auth Route
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.home');

    // Admin Components 
    Route::get('/admin/cart', [CartController::class, 'indexAdmin']);
    Route::get('/admin/user', [AdminController::class, 'indexAdmin']);
    Route::get('/admin/order', [OrderController::class, 'indexAdmin']);
    Route::get('/admin/product', [ProductController::class, 'indexAdmin']);
    Route::get('/admin/address', [AddressController::class, 'indexAdmin']);
    Route::get('/admin/category', [CategoryController::class, 'indexAdmin']);
    Route::get('/admin/sale', [SaleController::class, 'indexAdmin']);
    Route::get('/admin/wishlist', [WishListController::class, 'indexAdmin']);
    Route::get('/admin/carousel', [CarouselController::class, 'index']);
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
});


