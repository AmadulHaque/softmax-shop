<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>invoice card - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        margin-top: 20px;
        background-color: #eee;
      }

      .card {
        box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
      }

      .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0, 0, 0, .125);
        border-radius: 1rem;
      }
    </style>
  </head>
  <body>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
    <div id="container" class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="invoice-title">
                <h4 class="float-end font-size-15">
                    <img src="{{ asset($setting->logo) }}" style="width: 90px;margin-right: 20px;margin-top: 22px;" class="logo-icon" alt="logo icon">
                </h4>
                <div class="mb-4">
                  <h2 class="mb-1 text-muted">  {{ $setting->shop_title }}</h2>
                </div>
                <div class="text-muted">
                  <p class="mb-1">{{ $setting->address }},{{ $setting->address_two }}</p>
                  <p class="mb-1">{{ $setting->email }}</p>
                  <p>{{ $setting->phone }}</p>
                </div>
              </div>
              <hr class="my-4">
              <div class="row">
                <div class="col-sm-6">
                  <div class="text-muted">
                    <h5 class="font-size-16 mb-3">{{ $order->ship_name }}</h5>
                    <p class="mb-1">{{ $order->ship_address }}  , {{ $order->ship_postal_code }}</p>
                    <p class="mb-1">{{ $order->ship_email }}</p>
                    <p>{{ $order->ship_phone }}</p>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="text-muted text-sm-end">
                    <div>
                      <h5 class="font-size-15 mb-1">Invoice </h5>
                      <p># {{ $order->order_no }}</p>
                      <p>{{ $order->date }}</p>
                    </div>     
                  </div>
                </div>
              </div>
              <div class="py-2">
                <div class="table-responsive">
                  <table class="table align-middle table-nowrap table-centered mb-0">
                    <thead>
                      <tr>
                        <th style="width: 70px;">SL</th>
                        <th >Product Name</th>
                        <th class="text-right">Quantity</th>
                        <th class="text-right">Price </th>
                        <th class="text-right">Total Price</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php $total_sum = '0'; @endphp 
                        @foreach($order->orderDetails as $key => $details)
                      <tr>
                        <th scope="row"># {{ $key + 1 }}</th>
                        <td>
                          <div>
                            <h5 class="text-truncate font-size-14 mb-1">{{  $details->product['title'] }} </h5>
                            <p class="text-muted mb-0" style="text-transform: capitalize" >{{  $details->department}} - {{  $details->semester}}</p>
                          </div>
                        </td>
                        <td> <span style="font-size:22px">{{ $setting->currency }}</span> {{ $details->unit_price }}</td>
                        <td>{{ $details->selling_qty }}</td>
                        <td class="text-end"> <span style="font-size:22px">{{ $setting->currency }}</span>  {{ $details->selling_price }}</td>
                      </tr>

                      @php $total_sum += $details->selling_price; @endphp
                      @endforeach
                      <tr>
                        <th scope="row" colspan="4" class="text-end">Sub Total</th>
                        <td class="text-end"><span style="font-size:22px">{{ $setting->currency }}</span>  {{ $total_sum }}</td>
                      </tr>
                      <tr>
                        <th scope="row" colspan="4" class="border-0 text-end"> Discount :</th>
                        <td class="border-0 text-end"><span style="font-size:22px">{{ $setting->currency }}</span>  {{ $order->discount }}</td>
                      </tr>
                      <tr>
                        <th scope="row" colspan="4" class="border-0 text-end"> Shipping Charge :</th>
                        <td class="border-0 text-end"><span style="font-size:22px">{{ $setting->currency }}</span>  {{ $order->shipping }}</td>
                      </tr>
                      <tr>
                        <th scope="row" colspan="4" class="border-0 text-end"> Tax</th>
                        <td class="border-0 text-end"><span style="font-size:22px">{{ $setting->currency }}</span>  {{ $order->tax }}</td>
                      </tr>
                      <tr>
                        <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                        <td class="border-0 text-end">
                          <h4 class="m-0 fw-semibold"><span style="font-size:22px">{{ $setting->currency }}</span>  {{ $total_sum + $order->shipping + $order->tax -  $order->discount}}</h4>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="d-print-none mt-4">
                  <div class="float-end">
                    <a href="" id="printButton" class="btn btn-success me-1">
                      <i class="fa fa-print"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
          $('#printButton').click(function(e) {
            e.preventDefault();
            $('#container').removeClass('container')
            window.print();
          });
        });
        </script>
        
  </body>
</html>