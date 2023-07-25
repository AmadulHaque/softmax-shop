<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;



Route::get('login', [AuthController::class, 'Login'])->name('Login');
Route::get('/', [HomeController::class, 'Home'])->name('Home.index');

Route::group(['prefix' => 'page'], function () {

    Route::resource('/category', CategoryController::class);


});




require __DIR__.'/auth.php';
