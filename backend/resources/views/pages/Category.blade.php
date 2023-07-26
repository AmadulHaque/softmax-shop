@extends('app')
@section('content')

<div class="card">
    <div class="card-body p-4">
      <h5 class="card-title">Add New Category</h5>
      <hr>
      <div class="form-body mt-4">
        <div class="row">
          <div class="col-lg-8">
            <div class="table-responsive">
                <table id="table-load" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>C-Style</th>
                            <th>P-Category</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorys as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>
                                    @if ($item->category_style==1)
                                    One
                                    @else
                                    Two
                                    @endif
                                </td>
                                <td>{{ $item->parentCategory->name ?? 'N/A' }} </td>
                                <td style="width:73px" >
                                    <img class="rounded " src="{{ asset($item->image) }}"  style="width:100%"  alt="">
                                </td>
                                <td>
                                    @if ($item->status==1)
                                        <span class="active-bg" ><i class="lni lni-checkmark-circle"></i></span>
                                    @else
                                        <span class="inactive-bg"><i class="lni lni-cross-circle"></i></span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-success edit" data-id="{{ $item->id }}" ><i class="fadeIn animated bx bx-edit-alt"></i></button>
                                    <button type="button" class="btn btn-sm btn-outline-danger"><i class="fadeIn animated bx bx-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="border border-3 p-4 rounded">
                <form id="form" method="post">
                    @csrf
                    <x-category.form :categorys="$categorys"/>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

{{-- edit modal --}}

<div class="modal fade" id="CategoryEditModal" tabindex="-1" aria-labelledby="CategoryEditModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="FormValue" class="modal-body">
               
            </div>
        </div>
    </div>
</div>


@endsection()
@push('js')

<script>

$(document).ready(function() {
   $('#table-load').DataTable();
    
    $(document).on('submit','#form',function(e){
        e.preventDefault()
        let formData = new FormData($(this)[0]);
        loaderShow();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type:'post',
            url: '/page/category',
            data:formData,
            contentType:false,
            processData:false,
            success: function(res){
                loaderHide();
                if (res.success==false) {
                    $.each(res.errors, function(key, item){
                        ErrorToastFun(item)
                    })
                }else{
                    SuccessToastFun('Caegory Add Success!');
                    $('#form')[0].reset();
                      location.reload();
                }
            },
            error:function (response){
                loaderHide();
                console.log(response);
            }
        });
        console.log(formData);
    })

    $(document).on('click','.edit',function(e){
        e.preventDefault()
        let id = $(this).data('id');
        loaderShow();
        $.ajax({
            type:'get',
            url: '/page/category/'+id,
            success: function(res){
                loaderHide();
                $('#FormValue').html(res);
                $('#CategoryEditModal').modal('show')
            },
            error:function (response){
                console.log(response);
                loaderHide();
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
            url: '/page/category/'+id,
            data:formData,
            contentType:false,
            processData:false,
            success: function(res){
                loaderHide();
                if (res.success==false) {
                    $.each(res.errors, function(key, item){
                        ErrorToastFun(item)
                    })
                }else{
                    SuccessToastFun('Caegory Update Success!');
                    $('#UpdateForm')[0].reset();
                      location.reload();
                }
            },
            error:function (response){
                loaderHide();
                console.log(response);
            }
        });
        console.log(formData);
    })


});
</script>
@endpush()
 