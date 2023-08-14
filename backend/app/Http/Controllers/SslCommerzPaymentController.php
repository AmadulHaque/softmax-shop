<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
class SslCommerzPaymentController extends Controller
{

    public function index(Request $request)
    {
        // return $request; die;
        $Order = Order::count();
        $order_no =  $Order + 1;
        $customerC = DB::table('customers')->where('mobile_no',$request->phone)->where('email',$request->email)->count();
        if ($customerC > 0) {
            $customer = DB::table('customers')->where('mobile_no',$request->phone)->where('email',$request->email)->first();
            $cs_id = $customer->id;
        }else{
            $data= array();
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['mobile_no'] = $request->phone;
            $data['address'] = $request->address;
            $data['status'] = 1;
            $customer = DB::table('customers')->insertGetId($data);
            $cs_id = $customer;
        }
        $product =  Product::where('id',$request->product_id)->first();
        if ($product->offer_price > 0) {
            $amount = $product->offer_price;    
        }else{
            $amount = $product->price;
        }
        $post_data = array();
        $post_data['total_amount'] = $amount; 
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $order_no;
        # CUSTOMER INFORMATION
        $post_data['cus_name'] =  $request->name;
        $post_data['cus_email'] = $request->email;
        $post_data['cus_add1'] = $request->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] =$request->ship_postal_code;
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $request->phone;
        $post_data['cus_fax'] = "";
        # SHIPMENT INFORMATION
        $post_data['ship_name'] =   $request->name;
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = $request->ship_postal_code;
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";
        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";
        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";
        $update_product = DB::table('orders')->insertGetId([
            'order_no' => $post_data['tran_id'],
            'customer_id' => $cs_id,
            'amount' => $post_data['total_amount'],
            'pay_type' => 'sslcommerz',
            'ship_name' => $post_data['cus_name'],
            'ship_email' => $post_data['cus_email'],
            'ship_phone' => $post_data['cus_phone'],
            'ship_address' => $post_data['cus_add1'],
            'ship_postal_code' => $post_data['ship_postcode'],
            'shipping' =>0,
            'discount' => $request->discount,
            'date' => date('Y-m-d'),
            'status' => 3,
            'tax' => 0,
            'transaction_id' => $post_data['tran_id'],
            'currency' => $post_data['currency']
        ]);
        if ($update_product > 0) {
            $OrderDetails = new OrderDetails();
            $OrderDetails->date = date('Y-m-d');
            $OrderDetails->order_id = $update_product;
            $OrderDetails->product_id = $request->product_id;
            $OrderDetails->selling_qty = 1;
            $OrderDetails->unit_price = $amount;
            $OrderDetails->selling_price = $amount;
            $OrderDetails->department =$request->department;
            $OrderDetails->semester =$request->semester;
            $OrderDetails->status = '0';
            $OrderDetails->save();
        }
        $sslc = new SslCommerzNotification();
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');
        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }
    
    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $sslc = new SslCommerzNotification();
        #Check order status in order tabel against the transaction id or order id.
        $order = DB::table('orders')->where('transaction_id', $tran_id)->select('transaction_id', 'status', 'currency', 'amount','id')->first();
        $details = DB::table('order_details')->where('order_id',$order->id)->first();
        if ($order->status == '3') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);
            if ($validation) {
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => '0']);
            }
        } else if ($order->status == '3' || $order->status == '1') {
        } else {
        }
        $product = DB::table('products')->where('id',$details->product_id)->first();
        $redirectUrl = 'http://127.0.0.1:5173?slug=' . urlencode($product->slug).'&&status=success';
        return redirect($redirectUrl);
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $order = DB::table('orders')->where('transaction_id', $tran_id)->first();
        $details = DB::table('order_details')->where('order_id',$order->id)->first();
        $product = DB::table('products')->where('id',$details->product_id)->first();
        $redirectUrl = 'http://127.0.0.1:5173?slug=' . urlencode($product->slug).'&&status=fail';
        return redirect($redirectUrl);
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $update_product = DB::table('orders')->where('transaction_id', $tran_id)->update(['status' => '2']);
        $order = DB::table('orders')->where('transaction_id', $tran_id)->first();
        $details = DB::table('order_details')->where('order_id',$order->id)->first();
        $product = DB::table('products')->where('id',$details->product_id)->first();
        $redirectUrl = 'http://127.0.0.1:5173?slug=' . urlencode($product->slug).'&&status=cancel';
        return redirect($redirectUrl);
    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {
            $tran_id = $request->input('tran_id');
            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount','id')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    $update_product = DB::table('orders')->where('transaction_id', $tran_id)->update(['status' => 'Processing']);
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            } else {
            }
        } else {
        }
        $details = DB::table('order_details')->where('order_id',$order_details->id)->first();
        $product = DB::table('products')->where('id',$details->product_id)->first();
        $redirectUrl = 'http://127.0.0.1:5173?slug=' . urlencode($product->slug).'&&status=ipn';
        return redirect($redirectUrl);
    }
    

    
}
