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
use App\Http\Controllers\Admin\Pos\PosController;
use App\Http\Controllers\Admin\Pos\SupplierController;
use App\Http\Controllers\Admin\Pos\CustomerController;
use App\Http\Controllers\Admin\Pos\PurchaseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::get('login', [AuthController::class, 'Login'])->name('Login');
Route::group(['middleware' => 'auth'], function () {
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
    Route::resource('/supplier', SupplierController::class);
    Route::resource('/customer', CustomerController::class);

    // Purchase
    Route::get('/purchase', [PurchaseController::class, 'index']);
    Route::get('/purchase/pending', [PurchaseController::class, 'PurchasePending']);
    Route::get('/purchase/add', [PurchaseController::class, 'PurchaseAdd']);
    Route::get('/purchase/carts/{id}', [PurchaseController::class, 'PurchaseCarts']);
    Route::get('/purchase/carts', [PurchaseController::class, 'PurchaseCartsList']);
    Route::post('/purchase/store', [PurchaseController::class, 'PurchaseStore']);
    Route::get('/purchase/cart/update', [PurchaseController::class, 'PurchaseCartUpdate']);
    Route::get('/purchase/remove/{id}', [PurchaseController::class, 'PurchaseRemove']);
    Route::get('/purchase/Approved/{id}', [PurchaseController::class, 'PurchaseApproved']);


    
    //pos
    Route::get('/pos', [PosController::class, 'index']);
    Route::get('/pos/product/list', [PosController::class, 'ProductList']);
    Route::get('/pos/cart/list/{id}', [PosController::class, 'CartList']);
    Route::get('/pos/carts', [PosController::class, 'PosCartList']);
    Route::get('/pos/cart/update', [PosController::class, 'PosCartUpdate']);

    


    Route::get('/remove-product/img', [HomeController::class, 'ImgRemove']);
    Route::get('/remove-cart/remove/{id}', [HomeController::class, 'CartRemove']);
});
});


require __DIR__.'/auth.php';
