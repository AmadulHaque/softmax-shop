@extends('app')
@section('content')
@php
    $images=explode(',',$data->images);
@endphp
<div class="card">
    <div class="card-body p-4">
      <h5 class="card-title">Manage Product </h5>

      <hr>
      <div class="form-body mt-4">
        <div class="row">
          <div class="col-12">
            <form id="UpdateForm" data-id="{{ $data->id }}" method="POST" >
                @csrf 
                @method('put')
                <input type="hidden" name="id" value="{{ $data->id }}">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="border border-3 p-4 rounded">
                            <div class="mb-3">
                                <x-forms.input :type="'text'" :value="$data->title"  :name="'title'" :label="'Product Title'" :id="''" :placeholder="'Title'" :class="'form-control'" />
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Summery</label>
                                <textarea name="summery"  class="form-control"  cols="5" rows="5">{{ $data->summery }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label  class="form-label">Description</label>
                                <textarea name="description" id="editor" cols="2" rows="2">{{ $data->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <x-forms.input :type="'file'" :value="''"  :name="'thumbnail'" :label="'Product Thumbnail'" :id="'thumbnail'" :placeholder="''" :class="'form-control'" />
                                <img id="shoThumbnail" style="width:100px" src="{{ url($data->thumbnail) }}">
                            </div>
                            <div class="mb-3">
                                <label  class="form-label">Product Images</label>
                                <input  class="form-control" name="images[]" type="file" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" multiple>
                                
                                <div class="d-flex" >
                                  
                                    @foreach($images as $key=>$image)
                                        @if ($image)
                                        <div class="img_list{{ $key+1 }}" style="position: relative;margin: 6px;box-shadow: 0px 0px 5px 1px #b3afaf;border-radius: 8px;" >
                                            <img alt="" src="{{asset($image)}}" style="width: 101px;height: 100%;border: 1px solid #cdcdcd;border-radius: 7px;"/>
                                            <input type="hidden" name="old_images[]" value="{{ $image }}">
                                            <button type="button" class="btn btn-sm btn-outline-danger remove-files " data-url="{{ $image }}" data-id="{{ $key+1 }}" style="position: absolute;left: 0;top: 0;border: none;padding: 1px;margin: 0;" data-id="23"><i class="fadeIn animated bx bx-trash"></i></button>
                                        </div>
                                        @endif
                                        
                                    @endforeach
                               
                                </div>
                           
                            </div>

                            <div class="mb-3">
                                <x-forms.input :type="'text'" :value="$data->meta_title"  :name="'meta_title'" :label="'Meta Title'" :id="''" :placeholder="'Meta Title'" :class="'form-control'" />
                            </div>
                            <div class="mb-3">
                                
                                <label for="inputProductTags" class="form-label">Product Tags</label>
                                <input type="text" class="form-control" name="meta_keyword" id="inputProductTags" data-role="tagsinput" value="{{ $data->meta_keyword }}">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Meta Description</label>
                                <textarea name="meta_desc"  class="form-control"  cols="5" rows="5" placeholder="Meta Description">{{ $data->meta_desc }}</textarea>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="border border-3 p-4 rounded">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <x-forms.input :type="'number'" :value="$data->price"  :name="'price'" :label="'Product Price'" :id="''" :placeholder="'00.00'" :class="'form-control'" />
                                </div>
                                <div class="col-md-6">
                                    <x-forms.input :type="'number'" :value="$data->offer_price"  :name="'offer_price'" :label="'Offer Price'" :id="''" :placeholder="'00.00'" :class="'form-control'" />
                                </div>
                                <div class="col-md-6">
                                    <x-forms.input :type="'number'" :value="$data->qty"  :name="'qty'" :label="'Quantity'" :id="''" :placeholder="'Quantity..!'" :class="'form-control'" />
                                </div>
                                <div class="col-md-6">
                                    @php
                                        $options = $units;
                                    @endphp
                                    <x-forms.select :options="$options" :selected="$data->unit_id" :ovalue="'id'" :otext="'name'" :name="'unit_id'" :label="'Unit'" :id="''" :class="'form-control'" />
                                </div>
                               
                                <div class="col-12">
                                    <label for="inputProductTags" class="form-label">Product Size</label>
                                    <input type="text" class="form-control" name="size" id="inputProductTags" data-role="tagsinput" value="{{ $data->color }}">
                                </div>
                                <div class="col-12">
                                    <label for="inputProductTags" class="form-label">Product color</label>
                                    <input type="text" class="form-control" name="color" id="inputProductTags" data-role="tagsinput" value="{{ $data->color }}">
                                </div>

                                <div class="col-12">
                                    @php
                                        $options =$categorys;
                                    @endphp
                                    <x-forms.select :options="$options" :selected="$data->category_id" :ovalue="'id'" :otext="'name'" :name="'category_id'" :label="'Category'" :id="''" :class="'form-control'" />
                                </div>
                                <div class="col-12">
                                    @php
                                        $options = $brands;
                                    @endphp
                                    <x-forms.select :options="$options" :selected="$data->brand_id" :ovalue="'id'" :otext="'name'" :name="'brand_id'" :label="'Brand'" :id="''" :class="'form-control'" />
                                </div>
                                <div class="col-12">
                                    <label for="inputProductTags" class="form-label">Product Tags</label>
                                    <input type="text" class="form-control" name="tags" id="inputProductTags" data-role="tagsinput" value="{{ $data->tags }}">
                                </div>

                                <div class="col-12">
                                    <div class="form-check  form-switch">
                                        <input type="hidden"  name="trending"  @if ($data->trending==0) checked  @endif value="0">
                                        <input class="form-check-input cursor-pointer" type="checkbox" @if ($data->trending==1) checked  @endif id="trending" name="trending" value="1">
                                        <label class="form-check-label cursor-pointer" for="trending">Product Trending ?</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    @php
                                        $options = [
                                            ['id' => 1, 'value' => "Active"],
                                            ['id' => 0, 'value' => "InActive"]
                                        ];
                                    @endphp
                                    <x-forms.select :options="$options" :selected="$data->status" :ovalue="'id'" :otext="'value'" :name="'status'" :label="'Product Status'" :id="''" :class="'form-control'" />
                                </div>

                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn btn-success">Save Product</button>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>

                </div>
            </form>  
          </div>
        </div>
      </div>
    </div>
</div>


@endsection
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
            url: '/page/product/'+id,
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
                    ToastMessage("success","Product Update Success!",3000,'top-center');
                    $('#UpdateForm')[0].reset();
                    location.href = '/page/product'
                }
            },
            error:function (response){
                loaderHide();
                console.log(response);
            }
        });

    })

    $('.remove-files').on('click', function(){
        let id = $(this).data('id');
        let url = $(this).data('url');
        removeAlert().then((res) => {
            if (res) {
                loaderShow();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'get',
                    url: '/page/remove-product/img?url='+url,
                    contentType:false,
                    processData:false,
                    success: function(res){
                        loaderHide();
                        if (res.status==200) {
                            ToastMessage("success",res.message,3000,'top-center');
                            $('.img_list'+id).remove();
                        }else{
                            ToastMessage("error","Remove Faild",3000,'top-center');
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
});
</script>
@endpush()