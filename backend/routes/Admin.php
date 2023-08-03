<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductDetailImportantController;
use App\Http\Controllers\Admin\PdLearnController;
use App\Http\Controllers\Admin\BookReviewController;
use App\Http\Controllers\Admin\GiftController;
use App\Http\Controllers\Admin\QuationAnsController;
use App\Http\Controllers\Admin\BookNewsController;
use App\Http\Controllers\Admin\ProductDetailController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::get('login', [AuthController::class, 'Login'])->name('Login');
Route::get('/', [HomeController::class, 'Home'])->name('Home.index');
Route::get('/page/remove-product/img', [HomeController::class, 'ImgRemove']);

Route::group(['prefix' => 'page'], function () {
    Route::resource('/category', CategoryController::class);
    Route::resource('/brand', BrandController::class);
    Route::resource('/unit', UnitController::class);
    Route::resource('/product', ProductController::class);
    Route::resource('/pdimporant', ProductDetailImportantController::class);
    Route::resource('/pdlearn', PdLearnController::class);
    Route::resource('/BookReview', BookReviewController::class);
    Route::resource('/Gift', GiftController::class);
    Route::resource('/QuationAns', QuationAnsController::class);
    Route::resource('/BookNews', BookNewsController::class);
    Route::resource('/ProductDetail', ProductDetailController::class);

    Route::get('/remove-product/img', [HomeController::class, 'ImgRemove']);

});




require __DIR__.'/auth.php';
