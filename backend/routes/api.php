<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\SslCommerzPaymentController;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


  // order 
  Route::get('/getBy/one/{id}', [ProductController::class, 'ProductGetByOne']);
  Route::get('/products', [ProductController::class, 'products']);

  
  // SSLCOMMERZ Start
  Route::post('/payment', [SslCommerzPaymentController::class, 'index']);