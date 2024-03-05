<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CategoryWiseProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SingleProductDetails;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('search', [HomeController::class, 'search'])->name('product.search');
Route::get('malay-region', [HomeController::class, 'changeRegionToMalay'])->name('malay-region');
Route::get('bd-region', [HomeController::class, 'changeRegionToBangladesh'])->name('bd-region');

Route::fallback(function () {
    return view('frontend.404');
})->name('fallback');

require __DIR__.'/auth.php';

Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');

/** Product Listing Page Category wise  **/

Route::get('product-list/{category}', [CategoryWiseProductController::class, 'index'])->name('product.listing');

/** Single Product View Route**/
Route::get('product-details/{id}', [SingleProductDetails::class, 'index'])->name('product.details');

/** Cart Routes **/
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('cart-details', [CartController::class, 'cartDetails'])->name('cart-details');
Route::post('cart/update-quantity', [CartController::class, 'updateProductQty'])->name('cart.update-quantity');
Route::get('clear-cart', [CartController::class, 'clearCart'])->name('clear.cart');
Route::get('cart/remove-product/{rowId}', [CartController::class, 'removeProduct'])->name('cart.remove-product');
Route::get('cart-count', [CartController::class, 'getCartCount'])->name('cart.count');
Route::get('cart-total', [CartController::class, 'cartTotal'])->name('cart.total');
Route::get('apply-coupon', [CartController::class, 'applyCoupon'])->name('apply-coupon');
Route::get('coupon-calc', [CartController::class, 'couponCalc'])->name('coupon-calc');

/** Checkout Page Route **/
Route::get('checkout', [PaymentController::class, 'checkout'])->name('checkout');
Route::post('payment-bd', [PaymentController::class, 'bdPayment'])->name('payment-bd');

/** User Routes **/
Route::group(['middleware' => ['auth', 'verified', 'role:user'], 'prefix' =>'user', 'as' => 'user.'], function(){
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [UserProfileController::class, 'index'])->name('profile');
    Route::put('profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('password', [UserProfileController::class, 'updatePassword'])->name('password.update');
});

Route::get('faq', [HomeController::class, 'faq'])->name('faq');
Route::get('post-purchase', [HomeController::class, 'postPurchase'])->name('post-purchase');
Route::get('force-reg', [HomeController::class, 'forceReg'])->name('forceReg');
