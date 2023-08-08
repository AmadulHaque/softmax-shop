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
                <x-Order.table :datas="$datas"/>
            </div>
          </div>
          <div class="add-product d-none col-12">
           
          </div>
        </div>
      </div>
    </div>
</div>
@endsection()
@push('js')
<script>

$(document).ready(function() {
 
    $('#table-load').DataTable()

});
</script>
@endpush()
 