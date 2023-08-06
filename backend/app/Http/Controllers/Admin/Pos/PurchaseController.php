<?php

namespace App\Http\Controllers\Admin\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SuccessResource;
use App\Http\Requests\Purchase\AddRequest;
use App\Services\Pos\ServicePurchase;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Cart;
class PurchaseController extends Controller
{
    use ServicePurchase;

    public function index()
    {
        $datas = $this->purchases(1);
        return view('pages.Purchase',compact('datas'));
    }

    public function PurchasePending()
    {
        $datas = $this->purchases(0);
        return view('pages.PurchasePending',compact('datas'));
    }
    public function PurchaseAdd()
    {
        $brands = Brand::where('status',1)->get();
        $suppliers = Supplier::where('status',1)->get();
        $categorys = Category::where('status',1)->get();
        return view('pages.PurchaseAdd',compact('brands','categorys','suppliers'));
    }
    public function PurchaseRemove($id)
    {
       
        $this->purchaseDelete($id);
        return new SuccessResource(['message' => 'Successfully  deleted.']);  
    }
    
    
    public function PurchaseApproved($id)
    {
        $this->purchaseUpdate($id);
        return new SuccessResource(['message' => 'Successfully  Approved.']);
    }

    public function PurchaseCartsList()
    {
        $carts = $this->carts();
        return view('components.Purchase.cart',compact('carts'));
    }

    public function PurchaseCarts($id)
    {   
        $carts = $this->cartStore($id);
        return view('components.Purchase.cart',compact('carts'));
    }

    public function PurchaseStore(AddRequest $request)
    {   
        $data = $request->validated();
        $this->PurchaseCreate($data);
        return new SuccessResource($data);
    }

    public function PurchaseCartUpdate(Request $request)
    {   
        $this->CartUpdate($request);
        return true;
    }



}
