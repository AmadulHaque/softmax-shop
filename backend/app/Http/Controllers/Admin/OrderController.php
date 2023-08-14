<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ServiceOrder;
use App\Models\OrderDetails;
use App\Models\Order;
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

    public function ViewOrder($id)
    {
        $order = Order::with('orderDetails')->find($id);
        return view('pages.Order.OrderView',compact('order'));
    }
    public function CancleOrder()
    {
        $datas = $this->orders(2);
        return view('pages.Order.cancle',compact('datas'));
    }

    public function OrderFail()
    {
        $datas = $this->orders(3);
        return view('pages.Order.Fail',compact('datas'));
    }
    public function ApproveOrder($id)
    {
        $order = Order::with('orderDetails')->find($id);
        return view('pages.Order.pendingTable',compact('order'));
    }

    public function OrderStatusChange(Request $request,$id)
    {
        Order::where('id',$id)->update([
            'role'=> $request->status,
        ]);
        return response()->json([
            'success'=>true,
            'message'=>"Update Success!"
        ]);
    }

    public function ApproveOrderStore(Request $request,$id)
    {
        $datas = $this->OrderStore($request,$id);
        return response()->json($datas);
    }

    public function orderRemove($id)
    {
        $order = Order::where('id',$id)->delete();
        OrderDetails::where('order_id',$id)->delete();
        return response()->json([
            'success'=>true,
            'message'=>"Order Delete Success"
        ]);
    }
    public function OrderCancle($id)
    {
        $order = Order::where('id',$id)->update([
            'status'=>2
        ]);
        return response()->json([
            'success'=>true,
            'message'=>"Order Cancle Success"
        ]);
    }




 




}
