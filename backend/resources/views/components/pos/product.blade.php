
@foreach ($products as $item)
    
<div class="col-6 col-md-3">
    <div class="card bg-white c-pointer product-card hov-container">
        <div class="position-relative">
            <span class="absolute-top-left mt-1 ml-1 mr-0">
                @if ($item->qty > 0)
                <span class="badge bg-inline bg-success fs-13">In stock : {{ $item->qty }}</span></span>
                @else
                <span class="badge bg-inline bg-danger fs-13">Stock Out : {{ $item->qty }}</span></span>
                @endif
            <img src="{{ asset($item->thumbnail) }}" class="card-img-top img-fit h-120px h-xl-180px h-xxl-210px mw-100 mx-auto">
        </div>
        <div class="card-body p-2 p-xl-3">
            <div class="text-truncate fw-600 fs-14 mb-2">{{ $item->title }}</div>
            <div class="">
                <span>{{ $item->price }}</span>
                <span><del>{{ $item->offer_price }}</del></span>
            </div>
        </div> 
        @if ($pos == 1)
            <div class="{{$item->qty > 0 ? "add-plus" : " " }} absolute-full rounded overflow-hidden hov-box" data-id="{{ $item->id }}"   data-stock-id="589">
                <div class="absolute-full bg-dark opacity-50"></div>
                @if ($item->qty > 0)
                    <i class="lni lni-plus absolute-center text-white" style="font-size:60px;"></i>
                @else
                    <i class="lni lni-close absolute-center " style="color:red;font-size:60px;"></i>
                @endif
            </div>
        @else
            <div class="add-plus absolute-full rounded overflow-hidden hov-box" data-id="{{ $item->id }}" data-stock-id="589">
                <div class="absolute-full bg-dark opacity-50"></div>
                <i class="lni lni-plus absolute-center text-white" style="font-size:60px;"></i>
            </div>
        @endif
    </div>
</div>

@endforeach
@if(count($products) < 8)
    <tr><p class="text-center p-5">No Data Found</p></tr>
@else
    <div class="loadProduct loadProduct{{ $page }} text-center" page="{{$page}}">
        <div class="fs-14 d-inline-block fw-600 btn btn-soft-primary c-pointer" onclick="">Load More..</div>
    </div>
@endif
