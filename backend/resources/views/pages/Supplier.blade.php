@extends('app')
@section('content')

<div class="card">
    <div class="card-body p-4">
      <h5 class="card-title">Add New Supplier</h5>
      <hr>
      <div class="form-body mt-4">
        <div class="row">
          <div class="col-lg-8">
            <div class="table-responsive">
                <x-Supplier.table :datas="$datas"/>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="border border-3 p-4 rounded">
                <form id="form" method="post">
                    @csrf
                    <x-Supplier.form/>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

{{-- edit modal --}}
<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="FormValue" class="modal-body">
               
            </div>
        </div>
    </div>
</div>


@endsection()
@push('js')

<script>

$(document).ready(function() {
   $('#table-load').DataTable();
    
    $(document).on('submit','#form',function(e){
        e.preventDefault()
        let formData = new FormData($(this)[0]);
        loaderShow();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type:'post',
            url: '/page/supplier',
            data:formData,
            contentType:false,
            processData:false,
            success: function(res){
                loaderHide();
              
                if (res.success==false) {
                    $.each(res.errors, function(key, item){
                        ToastMessage("error",item,3000,'top-center');
                    })
                }else{
                    ToastMessage("success","Add Success!",3000,'top-center');
                    $('#form')[0].reset();
                    $('.table').load(location.href+' .table')
                }
            },
            error:function (response){
                loaderHide();
                console.log(response);
            }
        });
        console.log(formData);
    })

    $(document).on('click','.edit',function(e){
        e.preventDefault()
        let id = $(this).data('id');
        loaderShow();
        $.ajax({
            type:'get',
            url: '/page/supplier/'+id,
            success: function(res){
                loaderHide();
                $('#FormValue').html(res);
                $('#EditModal').modal('show')
            },
            error:function (response){
                console.log(response);
                loaderHide();
            }
        });
    })

    $(document).on('submit','#UpdateForm',function(e){
        e.preventDefault()
        let id = $(this).data('id');
        let formData = new FormData($(this)[0]);
        loaderShow();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type:'post',
            url: '/page/supplier/'+id,
            data:formData,
            contentType:false,
            processData:false,
            success: function(res){
                loaderHide();
                if (res.success==false) {
                    $.each(res.errors, function(key, item){
                        ErrorToastFun(item)
                    })
                }else{
                    $('#EditModal').modal('hide')
                    SuccessToastFun('Update Success!');
                    $('#UpdateForm')[0].reset();
                    // location.reload();
                    $('.table').load(location.href+' .table')
                }
            },
            error:function (response){
                loaderHide();
                console.log(response);
            }
        });

    })

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
                    url: '/page/supplier/'+id,
                    contentType:false,
                    processData:false,
                    success: function(res){
                        loaderHide();
                        if (res.success==false) {
                            ErrorToastFun(res.message)
                        }else{
                            SuccessToastFun(res.message);
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
 