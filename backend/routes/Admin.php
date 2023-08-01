<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductDetailImportantController;
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

    Route::get('/remove-product/img', [HomeController::class, 'ImgRemove']);

});




require __DIR__.'/auth.php';
