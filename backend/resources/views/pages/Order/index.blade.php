@extends('app')
@section('content')

<div class="card">
    <div class="card-body p-4">
      <h5 class="card-title">Manage Product 
        <div class="add-product-btn font-22 text-success cursor-pointer float-right">	<i class="lni lni-plus"></i></div>
        <div class="remove-product-btn font-22 text-danger cursor-pointer float-right d-none"><i class="lni lni-close"></i>
        </div>
      </h5>

      <hr>
      <div class="form-body mt-4">
        <div class="row">
          <div class="col-3 mb-3">
              <div class="input-form">
                <select id="status" class="form-control">
                  <option value="">All</option>
                  <option value="Status: processing">Processing</option>
                  <option value="Status: pick">Pick</option>
                  <option value="Status: shipped">Shipped</option>
                  <option value="Status: delivered">Delivered</option>
                </select>
              </div>
          </div>
          <div class="data-table col-12">
            <div class="table-responsive">
                <x-Order.table :datas="$datas"/>
            </div>
          </div>
          <div class="add-product d-none col-12">
           
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


  $(document).on('click','.OrderStatus',function(e){
    e.preventDefault();
    let status = $(this).data('val');
    let id = $(this).data('id');
    loaderShow();
    $.ajax({
        type:'get',
        url: '/page/order/status/change/'+id,
        data:{status:status},
        success: function(res){
            console.log(res);
            loaderHide();
            if (res.success==false) {
                ToastMessage("error",res.message,3000,'top-center');
            }else{
                ToastMessage("success",res.message,3000,'top-center');
                location.reload();
            }
        },
        error:function (response){
            console.log(response);
            loaderHide();
        }
    });
  })


  $("#status").on("change", function() {
      var value = $(this).val().toLowerCase();
      $("#table-load tbody tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
  });

});
</script>
@endpush()
 