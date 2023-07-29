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
          <div class="data-table  col-12">
            <div class="table-responsive">
                <x-product.table :products="$products"/>
            </div>
          </div>
          <div class="add-product d-none col-12">
            <form id="formPost" method="POST" >
                @csrf 
                <div class="row">
                    <x-product.form :categorys="$categorys" :brands="$brands" :units="$units" />
                </div>
            </form>  
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
    $('#table-load').DataTable();


    $('#fr-logo').addClass('d-none');
    $('#thumbnail').change(function(e){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#shoThumbnail').attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
	});
    
    $(document).on('submit','#formPost',function(e){
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
                console.log(res);
                loaderHide();
                if (res.success==false) {
                    $.each(res.errors, function(key, item){
                        ToastMessage("error",item,3000,'top-center');
                    })
                }else{
                    ToastMessage("success","Product Add Success!",3000,'top-center');
                    $('#formPost')[0].reset();
                    location.reload();
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
 