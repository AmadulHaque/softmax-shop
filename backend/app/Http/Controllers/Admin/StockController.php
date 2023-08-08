<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Product;
class StockController extends Controller
{

    public function Index()
    {
        $products = Product::where('status',1)->get();
        return view('pages.Stock.Index',compact('products'));
    }

}
