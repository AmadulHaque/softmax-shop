
@foreach ($carts as $item)  
    <li class="cart-li d-flex list-group-item">
        <div class="image">
            <div class="remove-item">
                <button type="button" class="btn btn-sm btn-outline-danger  remove" data-id="{{ $item->id }}"><i class="fadeIn animated bx bx-trash"></i></button>
            </div>
            <img src="{{ asset($item->product['thumbnail']) }}" alt="" srcset="">
        </div>
        <div class="product-title">
            <p>{{ $item->product['title'] }}</p>
            <p>Total Price : {{ $setting->currency }} {{ $item->buying_price }}</p>
        </div>
        <div class="product-price">
            <p>{{ $setting->currency }} {{ $item->unit_price }}</p>
            <input type="number" class="form-control cardUpdate qty{{$item->id}}" data-id="{{ $item->id }}" value="{{ $item->qty }}">
        </div>
    </li>
@endforeach

<input type="hidden" id="totalAmount" value="{{ $carts->sum('buying_price') }}" >