@extends('app')
@section('content')

<div class="card">
    <div class="card-body p-4">
      <h5 class="card-title">Manage Stock </h5>

      <hr>
      <div class="form-body mt-4">
        <div class="row">
          <div class="data-table  col-12">
            <div class="table-responsive">
                <table id="table-load" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Thumbnail</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>In Qty</th> 
                            <th>Out Qty </th>  
                            <th>Stock </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                            @php
                                $buying_total = App\Models\Purchase::where('product_id',$item->id)->where('status','1')->sum('buying_qty');
                                $selling_total = App\Models\OrderDetails::where('product_id',$item->id)->where('status','1')->sum('selling_qty');
                            @endphp
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td style="width:50px" >
                                    <img class="rounded " src="{{ asset($item->thumbnail) }}"  style="width:50px"  alt="">
                                </td>
                                <td>{{ $item->category->name }}</td>
                                <td>{{ $item->brand->name }}</td>
                                <td> 
                                    {{ $setting->currency }}
                                    @if ($item->offer_price > 0 )
                                        <del>{{ $item->price }}</del> 
                                        <span>{{ $item->offer_price }}</span> 
                                    @else 
                                    <span>{{ $item->price }}</span> 
                                    @endif
                                </td>
                                <td> <span class="btn btn-success">{{ $setting->currency }} {{ $buying_total  }}</span>  </td> 
                                <td> <span class="btn btn-info">{{ $setting->currency }}  {{ $selling_total  }}</span> </td> 
                                <td> <span class="btn btn-danger"> {{ $item->qty }}</span> </td> 
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>


@endsection()
@push('js')
<script>
$(document).ready(function() {
    $('#table-load').DataTable();
});
</script>
@endpush()
 