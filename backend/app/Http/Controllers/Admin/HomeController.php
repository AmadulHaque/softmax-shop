<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\{User,OrderDetails,Cart};
use Image,DB;


class HomeController extends Controller
{
    //
    public function Home() 
    {
        $purchases = DB::table('purchases')->where('status',1)->sum('buying_price');
        $invoice = DB::table('order_details')->where('status',1)->sum('selling_price');
        // amount sum end
        $customers =  DB::table('customers')->count();
        $suppliers =  DB::table('suppliers')->count();
        $purchasesCount =  DB::table('purchases')->where('status',1)->count();
        $invoiceCount =  DB::table('orders')->where('status',1)->count();
        //  count end
        $productStockOut = DB::table('products')->where('status',1)->where('qty',"<=",1)->get();
        $saleList = OrderDetails::where('status',1)->orderBy('id','asc')->latest()->limit(10)->get();
        // salse  monthly chart
        $amount_sales = OrderDetails::select(DB::raw("(SUM(selling_price)) as price"))
            ->whereYear('created_at',date('Y'))
            ->where('status',1)
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('price');
        $salse_months = OrderDetails::select(DB::raw("Month(created_at) as month"))
            ->whereYear('created_at',date('Y'))
            ->where('status',1)
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('month');
        $datas = [0,0,0,0,0,0,0,0,0,0,0,0];
        foreach($salse_months as $index => $month)
        {
        $datas[$month-1] = $amount_sales[$index];
        }
        
        $data = compact('saleList','productStockOut','purchases','invoice','customers','suppliers','purchasesCount','invoiceCount','datas');
        
        return view('pages.Dashboard',$data);    
    }

    public function ImgRemove(Request $request)
    {
        @unlink(public_path($request->url));
        return response()->json(
            ['status'=>200,'message' => 'Successfully Product Image deleted.']
        );
    }
    public function CartRemove($id)
    {
       Cart::where('id',$id)->delete();
       return true;
    }
    



}
