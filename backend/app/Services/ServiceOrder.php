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
        return ['message'=>'Invoice Approve Successfully','status' => 200 ,'success'=>true];
    }


    // public function ApprovalStore(Request $request, $id){
        // foreach($request->selling_qty as $key => $val){
        //     $invoice_details = InvoiceDetail::where('id',$key)->first();
        //     $product = Product::where('id',$invoice_details->product_id)->first();
        //     if($product->quantity < $request->selling_qty[$key]){
        //         $notification = array( 'message' => 'Sorry you approve Maximum Value', 'alert-type' => 'error');
        //         return redirect()->back()->with($notification);
        //     }
        // } // End foreach
        // $invoice = Invoice::findOrFail($id);
        // $invoice->updated_by = Auth::user()->id;
        // $invoice->status = '1';
        // DB::transaction(function() use($request,$invoice,$id){
        //     foreach($request->selling_qty as $key => $val){
        //      $invoice_details = InvoiceDetail::where('id',$key)->first();
        //      $invoice_details->status = '1';
        //      $invoice_details->save();
        //      $product = Product::where('id',$invoice_details->product_id)->first();
        //      $product->quantity = ((float)$product->quantity) - ((float)$request->selling_qty[$key]);
        //      $product->save();
        //     } // end foreach
        //     $invoice->save();
        // });
        // $notification = array( 'message' => 'Invoice Approve Successfully',  'alert-type' => 'success');
        // return redirect()->route('InvoicePendinglist')->with($notification);
    // }

   
}