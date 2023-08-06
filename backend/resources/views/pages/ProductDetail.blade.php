@extends('app')
@section('content')

<div class="card">
    <div class="card-body p-4">
        <h5 class="card-title">Manage Product Details
            <div class="add-product-btn font-22 text-success cursor-pointer float-right">	<i class="lni lni-plus"></i></div>
            <div class="remove-product-btn font-22 text-danger cursor-pointer float-right d-none"><i class="lni lni-close"></i>
            </div>
        </h5>
      <div class="form-body mt-4">
        <div class="row">
          <div class="tableList col-12">
            <div class="table-responsive">
                <x-ProductDetail.table :datas="$datas"/>
            </div>
          </div>
          <div class="addForm  d-none col-12">
            <div class="border border-3 p-4 rounded">
                <form id="form" method="post">
                    @csrf
                    <x-ProductDetail.form :product="$product"   :booknews="$BookNews" :bookreview="$BookReview" :gift="$Gift" :pdimpotrant="$PdImpotrant" :pdlearn="$PdLearn" :quationans="$QuationAns"/>
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

$(document).ready(function() {
    $('#table-load').DataTable();
    $('.multiple-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });

    $(document).on('submit','#form',function(e){
        e.preventDefault()
        let formData = new FormData($(this)[0]);
        loaderShow();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type:'post',
            url: '/page/ProductDetail',
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
                    ToastMessage("success"," Add Success!",3000,'top-center');
                    $('#form')[0].reset();
                    location.reload();
                }
            },
            error:function (response){
                loaderHide();
                console.log(response);
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
            url: '/page/ProductDetail/'+id,
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
                    ToastMessage("success","Update Success!",3000,'top-center');
                    $('#form')[0].reset();
                    $('#EditModal').modal('hide')
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
                    url: '/page/ProductDetail/'+id,
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

    $(document).on('click', '.add-product-btn', function() {
        $('.add-product-btn').addClass('d-none');
        $('.tableList').addClass('d-none');
        $('.remove-product-btn').removeClass('d-none');
        $('.addForm').removeClass('d-none');
    });
 
    $(document).on('click', '.remove-product-btn', function() {
        $('.remove-product-btn').addClass('d-none');
        $('.addForm').addClass('d-none');
        $('.tableList').removeClass('d-none');
        $('.add-product-btn').removeClass('d-none');
    });



});
</script>
@endpush()
 