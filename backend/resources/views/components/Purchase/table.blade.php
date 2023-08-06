<table id="table-load" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>P-N</th>
            <th>Date </th>
            <th>Supplier</th>
            <th>Qty</th>
            <th>Unit Price</th>
            <th>Total</th>
            <th>Product Name</th>
            <th>Product Image</th>
            <th>Status</th>
           @isset($datas[0]['status'])
            @if ($datas[0]['status']==0)
                <th>Action</th>
            @endif
           @endisset
        </tr>
    </thead>
    <tbody>
        @foreach($datas as $key => $item)
            <tr>
                <td> {{ $item->purchase_no }} </td>
                <td> {{ date('d-m-Y',strtotime($item->date))  }} </td>
                <td> {{ $item['supplier']['name'] }} </td>
                <td> {{ $item->buying_qty }} </td>
                <td> {{ $item->unit_price }} </td>
                <td> {{ $item->buying_price }} </td>
                <td> {{ $item['product']['title'] }} </td>
                <td> <img src="{{ asset( $item['product']['thumbnail'] ) }}" style="width:60px; height:50px"></td>
                <td>
                @if($item->status == '0')<span class="btn btn-warning">Pend..</span>
                @elseif($item->status == '1')<span class="btn btn-success">Approved</span>@endif
                </td>
                @if($item->status == '0')
                    <td><div class="col">
                        <a href="" class="btn btn-outline-success btn-sm Approved" data-id="{{$item->id}}" title="Approved" ><i class="lni lni-checkmark"></i></a>
                        <button type="button" class="btn btn-outline-danger btn-sm remove"  data-id="{{$item->id}}" ><i class="lni lni-trash"></i></button></div>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>