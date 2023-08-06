<?php
namespace App\Services\Pos;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\Cart;
use Auth;
use Illuminate\Database\Eloquent\Model;

trait ServicePurchase
{
    /**
     * Create new user
     * @param array $data
     * 
     * @return App\Models\User $user
     */
    public function PurchaseCreate($data)
    {
        $carts = Cart::orderBy('id','DESC')->where('status','buy')->get();
        $purchaseNo = Purchase::latest()->first();
        foreach ($carts as  $value) {
            $purchase = new Purchase();
            $purchase->date = date('Y-m-d', strtotime($data['date']));
            $purchase->purchase_no = $purchaseNo?->purchase_no==null ? 1 : $purchaseNo->purchase_no  + 1;
            $purchase->supplier_id = $data['supplier_id'];
            $purchase->product_id = $value->product_id;
            $purchase->buying_qty = $value->qty;
            $purchase->unit_price = $value->unit_price;
            $purchase->buying_price = $value->buying_price;
            $purchase->created_by = Auth::user()->id;
            $purchase->status = '0';
            $purchase->save();
        }
        $carts = Cart::orderBy('id','DESC')->where('status','buy')->delete();
        return true;
    }
    public function purchases($status)
    {
        $data =Purchase::latest()->where('status',$status)->get();
        return $data;
    }

    public function purchaseDelete($id)
    {
        $data = Purchase::findOrFail($id)->delete();
        return $data;
    }
    public function purchaseUpdate($id)
    {
        $purchase = Purchase::findOrFail($id);
        $product = Product::where('id',$purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty))+((float)($product->qty));
        $product->qty = $purchase_qty;
        if($product->save()){
            $purchase->update([
                'status' => '1',
            ]);
            return true;
        }
    }


    //// cart
    public function carts()
    {
        $data = Cart::orderBy('id','ASC')->where('status','buy')->get();
        return $data;
    }
    public function cartStore($id)
    {
        $product = Product::findOrFail($id);
        $check = Cart::checkCartBuy($id);
        if ($check) {
            $data = array();
            $data['qty'] = $check->qty + 1;
            $data['buying_price'] = ($check->qty + 1) * $check->unit_price;
            $check->update($data);
        }else{
            $data = array();
            $data['product_id'] = $id;
            $data['qty'] = 1;
            $data['unit_price'] = $product->price;
            $data['buying_price'] = $product->price;
            $data['status'] = 'buy';
            Cart::create($data);
        }
        $data = Cart::orderBy('id','ASC')->where('status','buy')->get();
        return $data;
    }
    
    public function CartUpdate($request)
    {
        $data = array();
        $data['qty'] = $request->qty;
        $data['unit_price'] = $request->unit_price;
        $data['buying_price'] = $request->qty * $request->unit_price;
        Cart::where('id',$request->id)->update($data);
        
    }

}