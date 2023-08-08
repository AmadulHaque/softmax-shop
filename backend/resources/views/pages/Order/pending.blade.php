@extends('app')
@section('content')

<div class="card">
    <div class="card-body p-4">
      <h5 class="card-title">New Order Manage </h5>
      <hr>
      <div class="form-body mt-4">
        <div class="row">
          <div class="data-table  col-12">
            <div class="table-responsive">
                <x-Order.table :datas="$datas"/>
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

    $(document).on('click', '.remove', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        removeAlert().then((res) => {
            if (res) {
                loaderShow();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'DELETE',
                    url: '/page/product/'+id,
                    contentType:false,
                    processData:false,
                    success: function(res){
                        loaderHide();
                        if (res.success==false) {
                            ToastMessage("error",res.message,3000,'top-center');
                        }else{
                            ToastMessage("success",res.message,3000,'top-center');
                            $('.table').load(location.href+' .table')
                        }
                    },
                    error:function (response){
                        console.log(response);
                        loaderHide();
                    }
                });
            } else {
                
            }
        });
    });


});
</script>
@endpush()
 