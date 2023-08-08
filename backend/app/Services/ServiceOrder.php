<?php
namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
trait ServiceProduct
{
    public function orders($status)
    {
        $data = Order::where('status',$status)->latest()->get();
        return $data;
    }
   
}