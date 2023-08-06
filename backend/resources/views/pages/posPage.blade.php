
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
                    <form action="" method="post">
                        @csrf
                        <div class="mb-3">
                            <select class="form-control single-select">
                                <option value="" selected disabled>-- select Customer --</option>
                                @foreach ($customers as $item)
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
									<li class="c-list-st pt-3 list-group-item d-flex justify-content-between align-items-center">Sub-Total	<span class="text-black p-2">৳ <span class="Sub_Total"></span> </span></li>
									<li class="c-list-st list-group-item d-flex justify-content-between align-items-center">Tax <span class="text-black p-2">৳ 00</span></li>
									<li class="c-list-st list-group-item d-flex justify-content-between align-items-center ">Shipping <span class="text-black p-2">৳ <span class="shipping" >00</span></span></li>
									<li class="c-list-st list-group-item d-flex justify-content-between align-items-center ">Discount <span class="text-black p-2">৳ <span class="discount">00</span></span></li>
                                    <h4 class="d-block m-1 pt-2">
                                        <span style="float: left;" >Total</span>
                                        <span style="float: right">৳ <span id="ShowTotalAmount">00</span> </span>
                                    </h4>
                                    <hr class="m-0">
								</ul>
                            </div>
                        </div> 
                        <div class="form-button">
                            <div class="btn-group">
                                <button type="button" class=" mt-2 btn btn-outline-dark split-bg-white dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">Shipping
                                    <i class="lni lni-chevron-up" style="font-size: 12px;"></i>
                                </button>
                                <div class="dropdown-style dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                                    <div class="input-group">
                                        <input type="number" min="0" placeholder="Amount" name="shipping" id="shipping" class="form-control" required="" onchange="">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Flat</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-group" style="margin-left: 10px;">
                                <button type="button" class=" mt-2 btn btn-outline-dark split-bg-white dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">Discount 
                                    <i class=" lni lni-chevron-up" style="font-size: 12px;"></i>
                                </button>
                                <div class="dropdown-style dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                                    <div class="input-group">
                                        <input type="number" min="0" placeholder="Amount" name="discount" id="discount" class=" form-control"  required="" onchange="">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Flat</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-group " style="float: right;">
                                <button type="button" class="mt-2  btn btn-primary btn-block" >Place Order</button>
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
        let pos = 1;
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
            url: '/page/pos/cart/list/'+id,
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

    cartsList()
    function cartsList(){
        let loader = $('#cart-loader');
        let cartAll = $('#cartAll');
        loader.removeClass('d-none');
        $.ajax({
            type:'get',
            url: '/page/pos/carts',
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
        let shipping = $('#shipping').val()
        let discount = $('#discount').val()
        let Amount = $('#totalAmount').val()
        $('.shipping').html(shipping)
        $('.discount').html(discount)
        $('.Sub_Total').text(Amount)

        let result = Amount + shipping - discount;
        $('#ShowTotalAmount').text(result)
    } 

    $(document).on('change', '.cardUpdate', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let qty = $('.qty'+id).val();
        $.ajax({
            type:'get',
            url: '/page/pos/cart/update',
            data:{id:id,qty:qty},
            success: function(data){
                cartsList()
            },
            error:function (response){
                console.log(response);
            }
        });
    });

    $(document).on('change', '#shipping', function(e) {
        e.preventDefault();
        loadAmount()
      
    });
    $(document).on('change', '#discount', function(e) {
        e.preventDefault();
        loadAmount()       
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
  
});
</script>

@endpush()
 