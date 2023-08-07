<?php

namespace App\Http\Controllers\Admin\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Order\AddRequest;
use App\Http\Resources\SuccessResource;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Brand;
use App\Services\Pos\ServicePos;
class PosController extends Controller
{
    use ServicePos;

    public function index()
    {
        $customers = Customer::where('status',1)->get();
        $brands = Brand::where('status',1)->get();
        $categorys = Category::where('status',1)->get();
        return view('pages.posPage',compact('brands','categorys','customers'));
    }

    public function placePosorder(Request $request)
    {
        $carts = $this->carts();
        $data = $request;
        return view('components.pos.OrderPlace',compact('carts','data'));
    }

    public function OrderPosPost(AddRequest $request)
    {
        $data = $request->validated();
        return new SuccessResource($data);
    }


    public function ProductList(Request $request)
    {
        $search = @$request->search;
        $page = @$request->page ? $request->page : 1;
        $query = Product::where('status',1);
        if($request->category){
            $query->where('category_id',$request->category);
        }
        if($request->brand){
            $query->where('brand_id',$request->brand);
        }
        if($search){
            $query->where('title', 'like', '%'.$search.'%')
            ->orWhere('tags', 'like', '%'.$search.'%');
        }
        $pos = $request->pos;
        $products = $query->latest('id')->paginate(8);
        return view('components.pos.product',compact('products','page','pos'));
    }

    public function PosCartList()
    {
        $carts = $this->carts();
        return view('components.pos.product_cart',compact('carts'));
    }

    public function CartList($id)
    {
        $carts = $this->cartStore($id);
        return view('components.pos.product_cart',compact('carts'));
    }
    
    public function PosCartUpdate(Request $request)
    {
        $this->CartUpdate($request);
        return true;
    }


}
