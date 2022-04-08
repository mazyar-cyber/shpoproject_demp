<?php

use App\Http\Controllers\admin\AdminAboutController;
use App\Http\Controllers\admin\AdminBrandController;
use App\Http\Controllers\admin\AdminMainController;
use App\Http\Controllers\admin\AdminSliderController;
use App\Http\Controllers\Admin\ProductCatController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\FrontEnd\FrontProductCatController;
use App\Http\Controllers\FrontEnd\FrontProductController;
use App\Http\Controllers\FrontEnd\MainController;
use App\Http\Controllers\FrontEnd\OrderController;
use App\Http\Controllers\FrontEnd\PaymentController;
use App\Models\ProductCat;
use App\Models\Temp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;






Route::prefix('/frontApi')->group(function () {
    Route::post('getCatProducts/{id}', [FrontProductCatController::class, 'getCatProducts']);
    Route::get('getBrands/{id}', [FrontProductCatController::class, 'getBrands']);
    Route::get('putProductToBasket/{id}', [FrontProductCatController::class, 'addProductToBasket']);
    Route::get('getBaskets', [MainController::class, 'getBaskets']);
    Route::get('addProductToBasket/{id}', [MainController::class, 'addProductToBasket']);
    Route::get('mineProductToBasket/{id}', [MainController::class, 'mineProductToBasket']);
    Route::get('removeProductFromBasket/{id}', [MainController::class, 'removeProductFromBasket']);
});







Route::get('/', function () {
    return view('welcome');
});
Route::resource('/', MainController::class);
Route::post('frontRegister', [MainController::class, 'register'])->name('front.register');
Route::resource('frontProduct', FrontProductController::class);
Route::resource('frontProductCat', FrontProductCatController::class);
Route::get('/about', [MainController::class, 'indexAboutPage']);
Route::get('/checkOut', [MainController::class, 'showCheckOutPage'])->middleware('auth');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/product', [MainController::class, 'showSingleProductPage'])->name('show.product');
Route::get("/payment/{id}", [PaymentController::class, 'verify'])->name('payment.verify');


Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::resource('/dashboard', AdminMainController::class);
        Route::resource('about', AdminAboutController::class);
        Route::resource('slider', AdminSliderController::class);
        Route::resource('productCat', ProductCatController::class);
        Route::resource('product', ProductController::class);
        Route::resource('brand', AdminBrandController::class);
        Route::post('/storeProductUpload', [ProductController::class, 'upload'])->name('store.productPhotos');
    });
    Route::prefix('api')->group(function () {
        Route::post('editProductCatName/{id}', [ProductCatController::class, 'editName']);
        Route::get('getProductsCat', [ProductCatController::class, 'getData']);
    });
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('logout', function () {
    Auth::logout();
    return redirect()->back();
});


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);

Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);






Route::get('test', function () {
    $tmps = Temp::all();
    foreach ($tmps as  $tmp) {
        if (Carbon::now()->diffInHours($tmp->created_at) > 2) {
            @unlink(public_path('photos\products\tmp\\' . $tmp->filename));
        }
    }
    // return ProductCat::find(2)->branchs;
});
