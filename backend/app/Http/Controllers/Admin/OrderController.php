<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ServiceOrder;
class OrderController extends Controller
{
    use ServiceOrder;

    public function Index()
    {
        $datas = $this->orders(1);
        return view('pages.Order.index',compact('datas'));
    }
    public function NewOrder()
    {
        $datas = $this->orders(0);
        return view('pages.Order.pending',compact('datas'));
    }
    public function CancleOrder()
    {
        $datas = $this->orders(2);
        return view('pages.Order.cancle',compact('datas'));
    }



}
