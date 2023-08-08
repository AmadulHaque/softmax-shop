<table id="table-load" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>O-N</th>
            <th>View</th>
            <th>Customer</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Status</th>
            <th>Remove</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $item)
            <tr>
                <td style="width:30px" >{{ $item->order_no }}</td>
                <td style="width:30px">
                    <a href="/page/order/approve/{{$item->id}}" target="_blanck" class="btn btn-outline-success btn-sm" data-id="15" title="Approved"><i class="fadeIn animated bx bx-link-external"></i></a>
                </td>
                <td>{{ $item->customer['name'] }}</td>
                <td>{{ $item->totalAmount }}</td>
                <td>{{ $item->date }}</td>
                <td>
                    @if ($item->status==1)
                        <span class="active-bg" ><i class="lni lni-checkmark-circle"></i></span>
                    @elseif($item->status==0)
                        <span class="btn btn-warning">Pend..<div></div></span>
                    @else
                        <span class="btn btn-danger">Canc..<div></div></span>
                    @endif
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-outline-danger  remove" data-id="{{ $item->id }}" ><i class="fadeIn animated bx bx-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>