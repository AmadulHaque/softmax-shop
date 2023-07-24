<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'Home'])->name('Home.index');



require __DIR__.'/auth.php';
