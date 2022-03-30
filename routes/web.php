<?php

use App\Http\Controllers\admin\AdminBrandController;
use App\Http\Controllers\admin\AdminMainController;
use App\Http\Controllers\admin\AdminSliderController;
use App\Http\Controllers\Admin\ProductCatController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\FrontEnd\FrontProductCatController;
use App\Http\Controllers\FrontEnd\FrontProductController;
use App\Http\Controllers\FrontEnd\MainController;
use Illuminate\Support\Facades\Route;






Route::prefix('/frontApi')->group(function () {
    Route::post('getCatProducts/{id}', [FrontProductCatController::class, 'getCatProducts']);
    Route::get('getBrands/{id}', [FrontProductCatController::class, 'getBrands']);
});







Route::get('/', function () {
    return view('welcome');
});
Route::resource('/', MainController::class);
Route::post('frontRegister', [MainController::class, 'register'])->name('front.register');
Route::resource('frontProduct', FrontProductController::class);
Route::resource('frontProductCat', FrontProductCatController::class);


Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::resource('/dashboard', AdminMainController::class);
        Route::resource('slider', AdminSliderController::class);
        Route::resource('productCat', ProductCatController::class);
        Route::resource('product', ProductController::class);
        Route::resource('brand',AdminBrandController::class);
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
