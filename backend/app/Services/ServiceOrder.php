<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetails;

trait ServiceOrder
{
    public function orders($status)
    {
        $data = Order::where('status',$status)->latest()->get();
        return $data;
    }

   
    public function OrderStore($request,$id)
    {
        foreach($request->id as  $key => $val){
            $order_details = OrderDetails::where('id',$val)->first();
            $product = Product::where('id',$order_details->product_id)->first();

            if($product->qty < $order_details->selling_qty){
                return ['message'=>'Sorry you approve Maximum Value','status' => 500 ,'success'=>false];
            }
        } 
        $order = Order::findOrFail($id);
        $order->status = '1';
        DB::transaction(function() use($request,$order,$id){
            foreach($request->id as $key => $val){
                $order_details = OrderDetails::where('id',$val)->first();
                $order_details->status = 1;
                $order_details->save();
                $product = Product::where('id',$order_details->product_id)->first();
                $product->qty = ((float)$product->qty) - ((float)$order_details->selling_qty);
                $product->save();
            }
            $order->save();

        });
        $num = $order->ship_phone;
        $msg = 'SoftmaxShop.com এ আপনার অর্ডারটি কনফার্ম করা হয়েছে। প্রোডাক্ট টি  সুন্দরবন কুরিয়ারের মাধ্যমে আগামী ২ থেকে ৩ কার্যদিবসের মধ্যে ডেলিভারি পাবেন ইনশা আল্লাহ । প্রয়োজনে 01739 334 500 এই নাম্বারে WhatsApp এ ম্যাসেজ করবেন।';
        smsPost($num,$msg);
        return ['message'=>'Invoice Approve Successfully','status' => 200 ,'success'=>true];
    }

}