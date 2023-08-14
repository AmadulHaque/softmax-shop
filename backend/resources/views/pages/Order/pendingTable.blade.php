@extends('app')
@section('content')
<div class="card">
    <div class="card-body p-4">
         
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div style="min-width: 600px" class="pb-3">
                                <header>
                                    <div class="row">
                                        <div class="col invoice-details" style="text-align:left;">
                                            <h1 class="invoice-id "><a href="javascript:;">Order #{{ $order->order_no }}</a></h1>
                                            <div class="date">Date of Order: {{ $order->date }} </div>
                                        </div>
                                        <div class="col company-details" style="text-align: right;">
                                            <h2 class="name"><a  href="javascript:;">{{ $order->ship_name }} </a></h2>
                                            <div> {{ $order->ship_address }} </div>
                                            <div> {{ $order->ship_phone }} </div>
                                            <div> {{ $order->ship_email }} </div>
                                            <div> {{ $order->ship_postal_code }} </div>
                                        </div>
                                    </div>
                                </header>
                            </div>

                            <form method="post" id="formPost">
                                @csrf 
                                <table border="1" class="table table-dark" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Sl</th>
                                        <th class="text-center">thumbnail</th>
                                        <th class="text-center">Product Name</th>
                                        <th class="text-center" style="background-color: #8B008B">Current Stock</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Unit Price </th>
                                        <th class="text-center">Total Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php $total_sum = '0'; @endphp 
                                        @foreach($order->orderDetails as $key => $details)
                                            <tr>
                                                <input type="hidden" name="id[]" value="{{ $details->id }}">
                                                <td class="text-center">{{ $key + 1 }}</td>
                                                <td class="text-center"><img style="width: 50px" src="{{ asset($details->product['thumbnail']) }}" alt=""></td>
                                                <td class="text-center">{{ $details->product['title'] }}</td>
                                                <td class="text-center" style="background-color: #8B008B">{{ $details->product['qty'] }}</td>
                                                <td class="text-center">{{ $details->selling_qty }}</td>
                                                <td class="text-center">{{ $setting->currency }} {{ $details->unit_price }}</td>
                                                <td class="text-center">{{ $setting->currency }} {{ $details->selling_price }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">Department : {{ $details->department }}</td>
                                                <td colspan="1"> Semester : {{ $details->semester }} </td>
                                                <td colspan="1"></td>
                                                <td colspan="1"></td>
                                                <td colspan="3"></td>
                                            </tr>
                                            @php $total_sum += $details->selling_price; @endphp
                                        @endforeach
                                        <tr>
                                            <td style="background: #171717;" colspan="7"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"></td>
                                            <td colspan="2"> Sub Total </td>
                                            <td class="text-center">{{ $setting->currency }} {{ $total_sum }} </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"></td>
                                            <td colspan="2"> Tax </td>
                                            <td class="text-center">{{ $setting->currency }}  {{ $order->tax }} </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"></td>
                                            <td colspan="2"> Shipping </td>
                                            <td class="text-center">{{ $setting->currency }}  {{ $order->shipping }} </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"></td>
                                            <td colspan="2"> Discount </td>
                                            <td class="text-center">{{ $setting->currency }}  {{ $order->discount }} </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"></td>
                                            <td colspan="2"> Grand Amount </td>
                                            <td class="text-center">{{ $setting->currency }} {{ $total_sum }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                @if ($order->status==1)
                                @else
                                <button type="submit" style="float: right" class="btn btn-success ">Order Approve </button>
                                @endif
                                <a href="/page/order/new" class="btn btn-danger mb-3" style="float:right;margin-right: 13px;">Back To List</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    
    </div>
</div>
@endsection()
@push('js')
<script>
var editor = new FroalaEditor('#editor');

$(document).ready(function() {
 
    $(document).on('submit','#formPost',function(e){
        e.preventDefault()
        let formData = new FormData($(this)[0]);
        let  id ={{ $order->id }}
        loaderShow();
        console.log(formData);
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url: '/page/order/approve/store/'+id,
            data:formData,
            contentType:false,
            processData:false,
            success: function(res){
                console.log(res);
                loaderHide();
                if (res.success==false) {
                    ToastMessage("error",res.message,3000,'top-center');
                }else{
                    ToastMessage("success","Order Approve Success!",3000,'top-center');
                    $('#formPost')[0].reset();
                    location.href = '/page/order';
                }
            },
            error:function (response){
                loaderHide();
                console.log(response);
            }
        });
    })
 
    


});
</script>
@endpush()
 