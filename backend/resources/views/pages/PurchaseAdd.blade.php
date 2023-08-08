
@extends('app')
@section('content')

<div class="">

    <div class="row">
        <div class="col-12 col-md-7">
            <div class="row">
                <div class="col-md-6 mb-2 mb-md-0">
                    <div class="form-group mb-0">
                        <input class="form-control form-control" type="text" id="search" name="search" placeholder="Search by Product Name">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group mb-0">
                        <select id="category" class="submitable form-control single-select">
                            <option value="" selected >All Category </option>
                            @foreach ($categorys as $item)
                                <option value="{{ $item->id }}"  > {{ $item->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group mb-0">
                        <select id="brand" class="submitable form-control single-select">
                            <option value="" selected >All Brand </option>
                            @foreach ($brands as $item)
                                <option value="{{ $item->id }}"> {{ $item->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="loader-product-div">
                <div id="products" class="row pt-3" style="height: 500px;overflow: auto;">
                    
                </div>
                <div id="product-loader" class="d-none load-spiner">
                    <div class="spinner-border" role="status"> <span class="visually-hidden">Loading...</span></div>
                </div>
            </div>

        </div>
        <div class="col-12 col-md-5">
            <div class="card p-3">
                <div class="form-body">
                    <form id="purchasePost" method="post">
                        @csrf
                        <div class="mb-3">
                            <select name="supplier_id" class="form-control single-select">
                                <option value="" selected disabled>-- select Supplier --</option>
                                @foreach ($suppliers as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="loader-product-div">
                            <div class="cart-list">
                                <ul id="cartAll" class="list-group">
                                    <tr><p class="text-center p-5">Cart Not Found</p></tr>
                                </ul>
                            </div> 
                            <div id="cart-loader" class="d-none load-spiner">
                                <div class="spinner-border" role="status"> <span class="visually-hidden">Loading...</span></div>
                            </div>
                        </div>
                        <div class="cart-body pt-3">
                            <div class="price-control">
                                <ul class="list-group">
									<input type="date" name="date" class="form-control">
                                    <h4 class="d-block m-1 pt-2">
                                        <span style="float: left;" >Total</span>
                                        <span style="float: right">{{ $setting->currency }} <span id="ShowTotalAmount" >00</span></span>
                                    </h4>
                                    <hr class="m-0">
								</ul>
                            </div>
                        </div> 
                        <div class="form-button">
                            <div class="btn-group " style="float: right;">
                                <button type="submit" class="mt-2  btn btn-primary btn-block" >Purchase Store</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
</div>



<audio id="audioPlayer">
    <source src="{{ asset('assets/audio/mixkit-classic-click-1117.wav') }}" type="audio/wav">
</audio>
<audio id="audioPlayerClose">
    <source src="{{ asset('assets/audio/mixkit-sci-fi-click-900.wav') }}" type="audio/wav">
</audio>
@endsection
@push('js')

<script>
    $(document).ready(function() {
        sideberHide()
        function sideberHide(){
            $(".toggle-icon").trigger('click');
        }
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });

    })
</script>
<script>
$(document).ready(function() {
    

    productLoad(1);
    function productLoad(page=1){
        let loader = $('#product-loader');
        let products = $('#products');
        let search = $('#search').val();
        let category = $('#category').val();
        let brand = $('#brand').val();
        let pos = 0;
        loader.removeClass('d-none');
        $.ajax({
            type:'get',
            url: '/page/pos/product/list?page='+page,
            data:{search:search,category:category,brand:brand,pos:pos},
            success: function(data){
                products.html(data);
                loader.addClass('d-none');
            },
            error:function (response){
                console.log(response);
            }
        });
    }

    $(document).on('change', '.submitable', function (e) {
        e.preventDefault();
          productLoad();
    });


    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
          productLoad();
    });

    $(document).on('click', '.loadProduct', function (e) {
        e.preventDefault();
        let page = $(this).attr('page');
        $('.loadProduct'+page).remove();
        if (page) {
            page++;
            let loader = $('#product-loader');
            let products = $('#products');
            let search = $('#search').val();
            let category = $('#category').val();
            let brand = $('#brand').val();
            loader.removeClass('d-none');
            $.ajax({
                type:'get',
                url: '/page/pos/product/list?page='+page,
                data:{search:search,category:category,brand:brand},
                success: function(data){
                    products.append(data);
                    loader.addClass('d-none');
                },
                error:function (response){
                    loaderHide();
                    console.log(response);
                }
            });
        }
    });
    
    cartsList()
    function cartsList(){
        let loader = $('#cart-loader');
        let cartAll = $('#cartAll');
        loader.removeClass('d-none');
        $.ajax({
            type:'get',
            url: '/page/purchase/carts',
            success: function(data){
                cartAll.html(data);
                loader.addClass('d-none');
                loadAmount();
            },
            error:function (response){
                console.log(response);
            }
        });
    }

    function  loadAmount(){
        let val = $('#totalAmount').val()
        $('#ShowTotalAmount').text(val)
    }    
    $(document).on('click', '.add-plus', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        const audioPlayer = $('#audioPlayer')[0];
        if (audioPlayer.paused) {
            audioPlayer.play();
        } else {
            audioPlayer.pause();
        }
        let loader = $('#cart-loader');
        let cartAll = $('#cartAll');
        loader.removeClass('d-none');
        $.ajax({
            type:'get',
            url: '/page/purchase/carts/'+id,
            success: function(data){
                cartAll.html(data);
                loader.addClass('d-none');
                loadAmount();
            },
            error:function (response){
                console.log(response);
            }
        });
    
     
    });



    $(document).on('change', '.cardUpdate', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let unit_price = $('.unit_price'+id).val();
        let qty = $('.qty'+id).val();
        $.ajax({
            type:'get',
            url: '/page/purchase/cart/update',
            data:{id:id,unit_price:unit_price,qty:qty},
            success: function(data){
                cartsList()
            },
            error:function (response){
                console.log(response);
            }
        });
    });


    $(document).on('click', '.remove', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        const audioPlayerClose = $('#audioPlayerClose')[0];
        if (audioPlayerClose.paused) {
            audioPlayerClose.play();
        } else {
            audioPlayerClose.pause();
        }
        $.ajax({
            type:'get',
            url: '/page/remove-cart/remove/'+id,
            contentType:false,
            processData:false,
            success: function(res){
                ToastMessage("success","Remove Success!",3000,'top-left');
                cartsList()
            },
            error:function (response){
                console.log(response);
            }
        });
    });


    
    $(document).on('submit','#purchasePost',function(e){
        e.preventDefault()
        let formData = new FormData($(this)[0]);
        loaderShow();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type:'post',
            url: '/page/purchase/store',
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
                    ToastMessage("success","Add Success!",3000,'top-center');
                    $('#purchasePost')[0].reset();
                    location.href='/page/purchase/pending';
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
 