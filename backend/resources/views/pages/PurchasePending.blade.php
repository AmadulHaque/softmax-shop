@extends('app')
@section('content')

<div class="card">
    <div class="card-body p-4">
      <h5 class="card-title">Manage Purchase</h5>
      <hr>
      <div class="form-body mt-4">
        <div class="row">
          <div class="data-table  col-12">
            <div class="table-responsive">
                <x-Purchase.table :datas="$datas"/>
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
        sideberHide()
        function sideberHide(){
            $(".toggle-icon").trigger('click');
        }
    })
</script>
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
                    type:'get',
                    url: '/page/purchase/remove/'+id,
                    contentType:false,
                    processData:false,
                    success: function(res){
                        loaderHide();
                        console.log(res);
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
            } else {
                
            }
        });
    });

    $(document).on('click', '.Approved', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        loaderShow();
        $.ajax({
            type:'get',
            url: '/page/purchase/Approved/'+id,
            contentType:false,
            processData:false,
            success: function(res){
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
    });

});
</script>
@endpush()
 