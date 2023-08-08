<input type="hidden" name="customer_id" value="{{ $data->customer_id }}">
<input type="hidden" name="shipping" value="{{ $data->shipping }}">
<input type="hidden" name="discount" value="{{ $data->discount }}">
<input type="hidden" name="name" value="{{ $data->name }}">
<input type="hidden" name="email" value="{{ $data->email }}">
<input type="hidden" name="postal_code" value="{{ $data->postal_code }}">
<input type="hidden" name="phone" value="{{ $data->phone }}">
<input type="hidden" name="address" value="{{ $data->address }}">

<div class="row">
    <div class="col-6">
        <div class="" style="height:450px;overflow: auto;">
            <ul  class="list-group">
                @foreach ($carts as $item)  
                <li class="cart-li d-flex list-group-item">
                    <div class="image">
                        <img src="{{ asset($item->product['thumbnail']) }}" alt="" srcset="">
                    </div>
                    <div class="product-title">
                        <p>{{ $item->product['title'] }}</p>
                        <p>Total Price : {{ $item->buying_price }}</p>
                    </div>
                    <div class="product-price">
                        <p>{{ $setting->currency }} {{ $item->unit_price }}</p>
                        <p>Quantity : {{ $item->qty }}</p>
                    </div>
                </li>
                @endforeach
            </ul>
        </div> 
    </div>
    <div class="col-6">
        <div class="card mb-4">
            <div class="card-header"><span class="fs-16">Customer Info</span></div>
            <div class="card-body">
                <div class="d-flex justify-content-between  mb-2">
                    <span class="">Name:</span>
                    <span class="fw-600">{{ $data->name }}</span>
                </div>
                <div class="d-flex justify-content-between  mb-2">
                    <span class="">Email:</span>
                    <span class="fw-600">{{ $data->email }}</span>
                </div>
                <div class="d-flex justify-content-between  mb-2">
                    <span class="">Phone:</span>
                    <span class="fw-600">{{ $data->phone }}</span>
                </div>
                <div class="d-flex justify-content-between  mb-2">
                    <span class="">Address:</span>
                    <span class="fw-600">{{ $data->address }}</span>
                </div>
                <div class="d-flex justify-content-between  mb-2">
                    <span class="">Postal Code:</span>
                    <span class="fw-600">{{ $data->postal_code }}</span>
                </div>
            </div>
        </div>
        <div class="payment"> 
            <div class="form-group mb-2">
                <div class="row">
                    <label class="col-sm-4 control-label" for="name">Payment Option</label>
                    <div class="col-sm-8">
                        <select id="PaymentType" name="pay_type" class="form-control" >
                            <option value="Hand-Cash">Hand Cash</option>
                            <option value="Bkash">Bkash</option>
                            <option value="Nagad">Nagad</option>
                            <option value="Roket">Roket</option>
                        </select>
                    </div>
                </div>
            </div>
            <div id="pay_number" class="d-none form-group mb-2">
                <div class="row">
                    <label class="col-sm-4 control-label" for="pay_number">Payment Number</label>
                    <div class="col-sm-8">
                        <input type="number" placeholder="Payment Number"  name="pay_number" class="form-control">
                    </div>
                </div>
            </div>

        </div>
        <div class="d-flex justify-content-between fw-600 mb-2 opacity-70">
            <span>Total</span>
            <span>{{ $setting->currency }}  {{ $carts->sum('buying_price') }} </span>
        </div>
        <div class="d-flex justify-content-between fw-600 mb-2 opacity-70">
            <span>Tax</span>
            <span>{{ $setting->currency }} 00</span>
        </div>
        <div class="d-flex justify-content-between fw-600 mb-2 opacity-70">
            <span>Shipping</span>
            <span>{{ $setting->currency }}  {{ $data->shipping }}</span>
        </div>
        <div class="d-flex justify-content-between fw-600 mb-2 opacity-70">
            <span>Discount</span>
            <span>{{ $setting->currency }}  {{ $data->discount }}</span>
        </div>
        <div class="d-flex justify-content-between fw-600 fs-18 border-top pt-2">
            @php
                $amount = $carts->sum('buying_price') + $data->shipping - $data->discount;
            @endphp
            <span>Total</span>
            <span>{{ $setting->currency }}  {{ $amount }}</span>
        </div>
    </div>
</div>

<div id="orderloader" class="d-none load-spiner">
    <div class="spinner-border" role="status"> <span class="visually-hidden">Loading...</span></div>
</div>