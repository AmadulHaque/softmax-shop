<table id="table-load" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>O-N</th>
            <th>View</th>
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
                    <a href="/page/order/approve/{{$item->id}}"  class="btn btn-outline-success btn-sm" data-id="15" title="Approved"><i class="fadeIn animated bx bx-link-external"></i></a>
                </td>
                <td>{{ $item->customer['name'] }}</td>
                <td>{{ $setting->currency }} {{ $item->totalAmount }}</td>
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
                            <button type="button" class="m-auto btn  btn-danger  cancle" data-id="{{ $item->id }}" >Cancle</button>
                        @endif
                        <button type="button" class="m-auto btn btn-sm  btn-outline-danger  remove" data-id="{{ $item->id }}" ><i class="fadeIn animated bx bx-trash"></i></button>
                    </td>
                @endif
               
            </tr>
        @endforeach
    </tbody>
</table>