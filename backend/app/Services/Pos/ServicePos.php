<?php
namespace App\Services\Pos;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\Cart;
use Auth;
use Illuminate\Database\Eloquent\Model;

trait ServicePos
{
 

    // cart
    public function carts()
    {
        $data = Cart::orderBy('id','ASC')->where('status','sale')->get();
        return $data;
    }
    public function cartStore($id)
    {
        $product = Product::findOrFail($id);
        $check = Cart::checkCartSale($id);
        if ($check) {
            $data = array();
            $data['qty'] = $check->qty + 1;
            $data['buying_price'] = ($check->qty + 1) * $check->unit_price;
            $check->update($data);
        }else{
            $data = array();
            $data['product_id'] = $id;
            $data['qty'] = 1;
            $data['unit_price'] =$product->price;
            $data['buying_price'] = $product->price;
            $data['status'] = 'sale';
            Cart::create($data);
        }
        $data = Cart::orderBy('id','ASC')->where('status','sale')->get();
        return $data;
    }
    
    public function CartUpdate($request)
    {
        $cart = Cart::findOrFail($request->id);
        $data = array();
        $data['qty'] = $request->qty;
        $data['buying_price'] = $request->qty * $cart->unit_price;
        Cart::where('id',$request->id)->update($data);
        
    }

}