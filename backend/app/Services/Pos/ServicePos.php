<?php
namespace App\Services\Pos;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetails;
use App\Models\Cart;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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


    public function OrderConfirm($request)
    {
        // Start the transaction
        DB::beginTransaction();
        try {
            $carts = Cart::orderBy('id', 'ASC')->where('status', 'sale')->get();
            if ($carts->count() > 0) {
            }else{
                return ['message' => 'Product is Empty','status' => 500,'success'=>true];
            }
            $Order = Order::count();
            $order_no =  $Order + 1;
            $order = new Order();
            $order->order_no = $order_no;
            $order->customer_id = $request->customer_id;
            $order->pay_type = $request->pay_type;
            $order->pay_number = $request->pay_number;
            $order->totalAmount = $carts->sum('buying_price');
            $order->tax = @$request->tax ? $request->tax : 0;
            $order->shipping = $request->shipping;
            $order->discount = $request->discount;
            $order->ship_name = $request->name;
            $order->ship_email = $request->email;
            $order->ship_phone = $request->phone;
            $order->ship_address = $request->address;
            $order->ship_postal_code = $request->postal_code;
            $order->date = date('Y-m-d');
            $order->status = '0';
            $order->created_by = Auth::user()->id;
            $order->save();
            foreach ($carts as $value) {
                $OrderDetails = new OrderDetails();
                $OrderDetails->date = date('Y-m-d');
                $OrderDetails->order_id = $order->id;
                $OrderDetails->product_id = $value->product_id;
                $OrderDetails->selling_qty = $value->qty;
                $OrderDetails->unit_price = $value->unit_price;
                $OrderDetails->selling_price = $value->buying_price;
                $OrderDetails->status = '0';
                $OrderDetails->save();
                $value->delete();
            }
            // Commit the transaction if all operations are successful
            DB::commit();
        } catch (\Exception $e) {
            // If an error occurs, rollback the transaction
            DB::rollback();
            // You can log the error or handle it in any way you prefer
            // For example:
            // Log::error($e->getMessage());
            // Return an error response or do whatever is appropriate for your use case
            return ['message' => 'Error processing the order','status' => 500,'success'=>true];
        }
        // Return a success response if everything went well
        return ['message'=>'Order processed successfully','status' => 200 ,'success'=>true];
    }


}