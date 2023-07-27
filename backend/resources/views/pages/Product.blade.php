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
          <div class="data-table col-12">
            <div class="table-responsive">
                <x-product.table :products="$products"/>
            </div>
          </div>
          <div class="add-product d-none col-12">
            <div class="row">
                <x-product.form />
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
var editor = new FroalaEditor('#editor');
$(document).ready(function() {
    $('#table-load').DataTable();
    // table = $('#table-load').DataTable({
    //         stateSave: true,
    //         retrieve: true,
    //         responsive: true,
    //         processing: true,
    //     });

    $('#image-uploadify').imageuploadify();
    $('.bxs-cloud-upload').addClass('d-none');
    $('.imageuploadify-message').addClass('d-none');

    
    $(document).on('submit','#form',function(e){
        e.preventDefault()
        let formData = new FormData($(this)[0]);
        loaderShow();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type:'post',
            url: '/page/product',
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
                    SuccessToastFun('Caegory Add Success!');
                    $('#form')[0].reset();
                    //   location.reload();
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
            url: '/page/product/'+id,
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
            url: '/page/product/'+id,
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
                    SuccessToastFun('Caegory Update Success!');
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
                    url: '/page/product/'+id,
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


    $(document).on('click', '.add-product-btn', function() {
        $('.add-product-btn').addClass('d-none');
        $('.data-table').addClass('d-none');
        $('.remove-product-btn').removeClass('d-none');
        $('.add-product').removeClass('d-none');
    });
 
    
    $(document).on('click', '.remove-product-btn', function() {
        $('.remove-product-btn').addClass('d-none');
        $('.add-product').addClass('d-none');
        $('.data-table').removeClass('d-none');
        $('.add-product-btn').removeClass('d-none');
    });

});
</script>
@endpush()
 