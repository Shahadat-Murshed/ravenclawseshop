<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\FAQController;
use App\Http\Controllers\Backend\ManagePaymentMethodController;
use App\Http\Controllers\Backend\ManageUserController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('notifications', [AdminController::class, 'notifications'])->name('notifications');

/** Notifactions **/
Route::get('mark-single-as-read/{id}', [AdminController::class, 'markSingleAsRead'])->name('markSingleAsRead');
Route::get('mark-all-as-read', [AdminController::class, 'markAsRead'])->name('markAllAsRead');

/** Profile Routes **/
Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile/update/password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');

/** Slider Routes **/
Route::put('slider/change-status', [SliderController::class, 'changeStatus'])->name('slider.change-status');
Route::resource('slider', SliderController::class);

/** Category Routes **/
Route::put('category/change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);

/** Produtcs Routes **/
Route::put('products/change-status', [ProductController::class, 'changeStatus'])->name('products.change-status');
Route::get('products/all/{category}', [ProductController::class, 'products'])->name('products.all.category');
Route::resource('products', ProductController::class);


/** Produtc Variants Routes **/
Route::get('products-variants/get-products', [ProductVariantController::class, 'getProducts'])->name('products-variants.get-products');
Route::put('products-variants/change-stock-status', [ProductVariantController::class, 'changeStock'])->name('products-variants.change-stock-status');
Route::put('products-variants/change-status', [ProductVariantController::class, 'changeStatus'])->name('products-variants.change-status');
Route::get('products-variants/pc-games', [ProductVariantController::class, 'pcGames'])->name('products-variants.pc-games');
Route::get('products-variants/mobile-games', [ProductVariantController::class, 'mobileGames'])->name('products-variants.mobile-games');
Route::get('products-variants/gift-Cards', [ProductVariantController::class, 'giftCards'])->name('products-variants.gift-cards');
Route::get('products-variants/subscriptions', [ProductVariantController::class, 'subscriptions'])->name('products-variants.subscriptions');
Route::get('product-variants/{slug}', [ProductVariantController::class, 'productVariants'])->name('product-variants');;
Route::resource('products-variants', ProductVariantController::class);

/** Coupon Routes */
Route::put('coupons/change-status', [CouponController::class, 'changeStatus'])->name('coupons.change-status');
Route::resource('coupons', CouponController::class);

Route::group(['middleware' => 'isSuperAdmin'], function () {
});
/** Order Routes **/
Route::put('payment-status', [OrderController::class, 'changePaymentStatus'])->name('order.payment.status');
Route::put('order-status', [OrderController::class, 'changeOrderStatus'])->name('order.status');
Route::get('orders-returnedOrder', [OrderController::class, 'returnedOrder'])->name('orders.returnedOrder');
Route::get('orders-failedOrder', [OrderController::class, 'failedOrder'])->name('orders.failedOrder');
Route::get('orders-refundedOrder', [OrderController::class, 'refundedOrder'])->name('orders.refundedOrder');
Route::get('orders-cancelledOrder', [OrderController::class, 'cancelledOrder'])->name('orders.cancelledOrder');
Route::get('orders-completedOrder', [OrderController::class, 'completedOrder'])->name('orders.completedOrder');
Route::get('orders-holdOrder', [OrderController::class, 'holdOrder'])->name('orders.holdOrder');
Route::get('orders-deliveredOrder', [OrderController::class, 'deliveredOrder'])->name('orders.deliveredOrder');
Route::get('orders-processingOrder', [OrderController::class, 'processingOrder'])->name('orders.processingOrder');
Route::get('orders-pendingOrder', [OrderController::class, 'pendingOrder'])->name('orders.pendingOrder');
Route::get('orders-globalOrder', [OrderController::class, 'globalOrder'])->name('orders.globalOrder');
Route::get('orders-malayOrder', [OrderController::class, 'malayOrder'])->name('orders.malayOrder');
Route::resource('orders', OrderController::class);

/** Transaction Routes **/
Route::get('all-transactions', [TransactionController::class, 'index'])->name('transactions.all');

/** FAQ Routes **/
Route::resource('faqs', FAQController::class);


Route::group(['middleware' => 'isSuperAdmin'], function () {
    /** Manage Users Routes  **/
    Route::get('users-list', [ManageUserController::class, 'users'])->name('users.list');
    Route::get('admins-list', [ManageUserController::class, 'admins'])->name('admins.list');
    Route::get('guests-list', [ManageUserController::class, 'guests'])->name('guests.list');
    Route::put('user-list/change-status', [ManageUserController::class, 'changeStatus'])->name('users.change-status');
    Route::put('user-changeRole', [ManageUserController::class, 'changeRole'])->name('users.changeRole');
    Route::delete('user-destroy/{id}', [ManageUserController::class, 'destroy'])->name('user.destroy');

    /** Manage Payments Routes  **/
    Route::get('all-payment-methods', [ManagePaymentMethodController::class, 'index'])->name('payments.all.list');
    Route::get('payment-method/{id}/edit', [ManagePaymentMethodController::class, 'edit'])->name('paymentmethods.edit');
    Route::put('payment-method/{id}', [ManagePaymentMethodController::class, 'update'])->name('paymentmethods.update');
    Route::put('make-default', [ManagePaymentMethodController::class, 'makeDefault'])->name('paymentmethods.default');
    Route::delete('payment-method/{id}', [ManagePaymentMethodController::class, 'destroy'])->name('paymentmethods.destroy');
    /** Manage bKash Routes  **/
    Route::get('bkash-payment-methods', [ManagePaymentMethodController::class, 'bkash'])->name('payments.bkash.list');
    Route::get('create-bkash', [ManagePaymentMethodController::class, 'createbkash'])->name('payments.bkash.create');
    Route::post('bkash-payment-methods', [ManagePaymentMethodController::class, 'storebkash'])->name('payments.bkash.store');
    /** Manage Payments Routes  **/
    Route::get('nagad-payment-methods', [ManagePaymentMethodController::class, 'nagad'])->name('payments.nagad.list');
    Route::get('create-nagad', [ManagePaymentMethodController::class, 'createNagad'])->name('payments.nagad.create');
    Route::post('nagad-payment-methods', [ManagePaymentMethodController::class, 'storeNagad'])->name('payments.nagad.store');
    /** Manage Payments Routes  **/
    Route::get('rocket-payment-methods', [ManagePaymentMethodController::class, 'rocket'])->name('payments.rocket.list');
    Route::get('create-rocket', [ManagePaymentMethodController::class, 'createRocket'])->name('payments.rocket.create');
    Route::post('rocket-payment-methods', [ManagePaymentMethodController::class, 'storeRocket'])->name('payments.rocket.store');
    /** Manage Payments Routes  **/
    Route::get('crypto-payment-methods', [ManagePaymentMethodController::class, 'crypto'])->name('payments.crypto.list');
    Route::put('default-crypto/{id}', [ManagePaymentMethodController::class, 'rocketDefault'])->name('payments.crypto.default');

    /** Manage Payments Routes  **/
    Route::get('cryptox-payment-methods', [ManagePaymentMethodController::class, 'cryptox'])->name('payments.cryptox.list');
    Route::put('default-cryptox/{id}', [ManagePaymentMethodController::class, 'cryptoxDefault'])->name('payments.cryptox.default');

    /** Manage Payments Routes  **/
    Route::get('cryptoy-payment-methods', [ManagePaymentMethodController::class, 'cryptoy'])->name('payments.cryptoy.list');
    Route::put('default-cryptoy/{id}', [ManagePaymentMethodController::class, 'cryptoyDefault'])->name('payments.cryptoy.default');
});
