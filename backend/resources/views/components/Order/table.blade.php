<style>
.processing{
    background: #df1e1e;
    color: #fff;
}
.pick{
    background: #df451e;
    color: #fff;
}
.shipped{
    background: #1ea0df;
    color: #fff;
}
.delivered{
    background: #277d00;
    color: #fff;
}

</style>
<table id="table-load" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>O-N</th>
            <th>View</th>
            @isset($datas[0])
                @if ($datas[0]['status']==1)
                <th>Delivery-Status</th>
                @else
                @endif
            @endisset
            <th>Customer</th>
            <th>Amount</th>
            <th>Date</th>
            <th class="text-center">Status</th>
            @isset($datas[0])
                @if ($datas[0]['status']==1)
                @else
                <th>Action</th>
                @endif
            @endisset
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $item)
            <tr>
                <td style="width:30px" >{{ $item->order_no }}</td>
                <td style="width:30px">
                    <a href="/page/order/approve/{{$item->id}}"  class="btn btn-outline-success btn-sm"  title="Approved"><i class="fadeIn animated bx bx-link-external"></i></a>
                    <a href="/page/order/view/{{$item->id}}"  class="btn btn-outline-danger btn-sm" target="_blanck" title="Print"><i class="lni lni-printer"></i></a>
                </td>
                @if ($item->status==1)
                    <td style="width: 15%;">
                        <div class="btn-group d-block">
							<button type="button" style="width:100%;" class="btn btn-primary {{ $item->role  }} d-block split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">Status: {{ $item->role  }}</button>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end" style="margin: 0px;">
                                <a class="dropdown-item  OrderStatus" data-id="{{ $item->id }}" data-val="processing"  href="javascript:;" >Processing</a>
                                <a class="dropdown-item  OrderStatus" data-id="{{ $item->id }}" data-val="pick"  href="javascript:;" >Pick-Up</a>
                                <a class="dropdown-item  OrderStatus" data-id="{{ $item->id }}" data-val="shipped"  href="javascript:;" >Shipped</a>
                                <a class="dropdown-item  OrderStatus" data-id="{{ $item->id }}" data-val="delivered"  href="javascript:;" >Delivered</a>
							</div>
						</div>
                    </td>
                @else
                @endif
                <td>{{ $item->customer['name'] }}</td>
                <td>{{ $setting->currency }} {{ $item->amount }}</td>
                <td>{{ $item->date }}</td>
                <td class="text-cener">
                    @if ($item->status==1)
                        <span class="active-bg" ><i class="lni lni-checkmark-circle"></i></span>
                    @elseif($item->status==0)
                        <span class=" d-block btn btn-warning">Pend..<div></div></span>
                    @else
                        <span class="d-block btn btn-danger">Canc..<div></div></span>
                    @endif
                </td>
                @if ($item->status==1)
                @else  
                    <td class="text-cener" style="width:25px">
                        @if ($item->status==0)
                            <button type="button" class="m-auto btn  btn-danger  cancle" data-id="{{ $item->id }}" >Cancel</button>
                        @endif
                        <button type="button" class="m-auto btn btn-sm  btn-outline-danger  remove" data-id="{{ $item->id }}" ><i class="fadeIn animated bx bx-trash"></i></button>
                    </td>
                @endif
               
            </tr>
        @endforeach
    </tbody>
</table>