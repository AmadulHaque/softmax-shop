@extends('app')
@section('content')

<div class="card">
    <div class="card-body p-4">
      <h5 class="card-title">Manage Purchase</h5>
      <hr>
      <div class="form-body mt-4">
        <div class="row">
          <div class="data-table  col-12">
            <div class="table-responsive">
                <x-Purchase.table :datas="$datas"/>
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
});
</script>
@endpush()
 