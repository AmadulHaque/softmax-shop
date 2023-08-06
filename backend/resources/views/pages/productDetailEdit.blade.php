@extends('app')
@section('content')

@php
    $PD_important =explode(',',$data->PD_important_id);
    $PD_learn =explode(',',$data->PD_learn_id);
    $qas =explode(',',$data->qa_id);
    $book_review =explode(',',$data->book_review_id);
    $book_news =explode(',',$data->book_news_id);
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
               
                <div class="row g-3">
                    <div class="col-6">
                        @php
                            $options = $product;
                        @endphp
                        <x-forms.select :options="$options" :selected="$data->product_id" :ovalue="'id'" :otext="'title'" :name="'product_id'" :label="'Product'" :id="''" :class="'form-control'" />
                    </div>
                    <div class="col-6">
                        <x-forms.input :type="'text'" :value="$data->title"  :name="'title'" :label="'Title'" :id="''" :placeholder="'title'" :class="'form-control'" />
                    </div>
                    <div class="col-6">
                        <x-forms.input :type="'text'" :value="$data->sub_title"  :name="'sub_title'" :label="'Sub Title'" :id="''" :placeholder="'Sub Title'" :class="'form-control'" />
                    </div>
                    <div class="col-6">
                        <x-forms.input :type="'text'" :value="$data->video_one_url"  :name="'video_one_url'" :label="'video one url'" :id="''" :placeholder="'video one url'" :class="'form-control'" />
                    </div>
                    <div class="col-6">
                        <x-forms.input :type="'text'" :value="$data->important_title"  :name="'important_title'" :label="'Important Title'" :id="''" :placeholder="'Important Title'" :class="'form-control'" />
                    </div>
                    <div class="col-6">
                        <label class="form-label">PD-important</label>
                        <select name="PD_important_id[]" class="multiple-select" data-placeholder="Choose anything" multiple="multiple">
                           @foreach ($pdimpotrant as $item)
                               <option @if (in_array($item->id, $PD_important)) selected @endif value="{{ $item->id }}" >{{ $item->title }}</option>
                           @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <x-forms.input :type="'text'" :value="$data->important_desc"  :name="'important_desc'" :label="'Important-description'" :id="''" :placeholder="'Important-description'" :class="'form-control'" />
                    </div>
                    <div class="col-6">
                        <x-forms.input :type="'text'" :value="$data->PD_learn_title"  :name="'PD_learn_title'" :label="'PD-Learn-Title'" :id="''" :placeholder="'PD-Learn-Title'" :class="'form-control'" />
                    </div>
                    <div class="col-6">
                        <label class="form-label">PD-Learn</label>
                        <select name="PD_learn_id[]" class="multiple-select" data-placeholder="Choose anything" multiple="multiple">
                            @foreach ($pdlearn as $item)
                            <option @if (in_array($item->id, $PD_important)) selected @endif value="{{ $item->id }}" >{{ $item->title }}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Gift</label>
                        <select name="gift_id" class="form-control"  >
                            <option value=""  >-- select --</option>
                            @foreach ($gift as $item)
                                <option @if ($item->id==$data->gift_id) selected  @endif value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-6">
                        @isset($data->PD_image_one)
                        <img id="PD_image_one" style="width:100px" src="{{ asset($data->PD_image_one) }}">
                        @endisset
                        <x-forms.input :type="'file'" :value="''" :name="'PD_image_one'" :label="'PD-Image-One'" :id="'PD_image_oneS'" :placeholder="''" :class="'form-control'" />
                    </div>
                    <div class="col-6">
                        @isset($data->PD_image_two)
                        <img id="PD_image_two" style="width:100px" src="{{ asset($data->PD_image_two) }}">
                        @endisset
                        <x-forms.input :type="'file'" :value="''" :name="'PD_image_two'" :label="'PD-Image-Two'" :id="'PD_image_twoS'" :placeholder="''" :class="'form-control'" />
                    </div>
                    <div class="col-6">
                        <x-forms.input :type="'text'" :value="$data->video_two_title" :name="'video_two_title'" :label="'Video Two Title'" :id="''" :placeholder="'Video Two Title'" :class="'form-control'" />
                    </div>
                    <div class="col-6">
                        <x-forms.input :type="'text'" :value="$data->video_two_url" :name="'video_two_url'" :label="'Video Two url'" :id="''" :placeholder="'Video Two url'" :class="'form-control'" />
                    </div>
                    <div class="col-6">
                        <x-forms.input :type="'text'" :value="$data->video_desc"  :name="'video_desc'" :label="'Video Description'" :id="''" :placeholder="'Video Description'" :class="'form-control'" />
                    </div>
                    <div class="col-6">
                        <x-forms.input :type="'text'" :value="$data->review_title"  :name="'review_title'" :label="'Video Title'" :id="''" :placeholder="'Video Title'" :class="'form-control'" />
                    </div>
                    <div class="col-6">
                        <x-forms.input :type="'text'" :value="$data->review_video"  :name="'review_video'" :label="'Review Video'" :id="''" :placeholder="'Review Video'" :class="'form-control'" />
                    </div>
                    <div class="col-6">
                        <x-forms.input :type="'text'" :value="$data->review_desc"  :name="'review_desc'" :label="'Review Description'" :id="''" :placeholder="'Review Description'" :class="'form-control'" />
                    </div>
                    <div class="col-6">
                        @isset($data->review_images)
                        <img id="review_images" style="width:100px" src="{{ asset($data->review_images) }}">
                        @endisset
                        <x-forms.input :type="'file'" :value="''" :name="'review_images'" :label="'Review-Image'" :id="'review_imagesS'" :placeholder="''" :class="'form-control'" />
                    </div>
                    <div class="col-6">
                        <x-forms.input :type="'text'" :value="$data->order_title"  :name="'order_title'" :label="'Order Title'" :id="''" :placeholder="'Order Title'" :class="'form-control'" />
                    </div>
                    <div class="col-6">
                        @isset($data->order_image)
                        <img id="order_image" style="width:100px" src="{{ asset($data->order_image) }}">
                        @endisset
                        <x-forms.input :type="'file'" :value="''" :name="'order_image'" :label="'Order-Image'" :id="'order_imageS'" :placeholder="''" :class="'form-control'" />
                    </div>
                    <div class="col-6">
                        <x-forms.input :type="'text'" :value="$data->motive_title" :name="'motive_title'" :label="'Motivational-Title'" :id="''" :placeholder="'Motivational-Title'" :class="'form-control'" />
                    </div>
                    <div class="col-6">
                        <x-forms.input :type="'text'" :value="$data->order_video_url" :name="'order_video_url'" :label="'Motivational-video-url'" :id="''" :placeholder="'Motivational-Video-url'" :class="'form-control'" />
                    </div>
                    <div class="col-6">
                        <x-forms.input :type="'text'" :value="$data->motive_title_two" :name="'motive_title_two'" :label="'Motivational-Title-Two'" :id="''" :placeholder="'Motivational-Title-Two'" :class="'form-control'" />
                    </div>
                    <div class="col-6">
                        <label class="form-label">Quotation-Answer</label>
                        <select name="qa_id[]" class="multiple-select" data-placeholder="Choose anything" multiple="multiple">
                            @foreach ($quationans as $item)
                                <option  @if (in_array($item->id, $qas)) selected @endif value="{{ $item->id }}" value="{{ $item->id }}">{{ $item->quotaion }}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Book-Review</label>
                        <select name="book_review_id[]" class="multiple-select" data-placeholder="Choose anything" multiple="multiple">
                            @foreach ($bookreview as $item)
                                <option @if (in_array($item->id, $book_review)) selected @endif value="{{ $item->id }}" value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach 
                        </select>
                    </div>
                    
                    <div class="col-6">
                        <x-forms.input :type="'text'" :value="$data->book_news_title" :name="'book_news_title'" :label="'Book-News-Title'" :id="''" :placeholder="'Book-News-Title'" :class="'form-control'" />
                    </div>
                    <div class="col-6">
                        <label class="form-label">Book-News</label>
                        <select name="book_news_id[]" class="multiple-select" data-placeholder="Choose anything" multiple="multiple">
                            @foreach ($booknews as $item)
                            <option @if (in_array($item->id, $book_news)) selected @endif value="{{ $item->id }}" value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach 
                        </select>
                    </div>
                
                    <div class="col-3  mt-3">
                        <div class="d-grid">
                            <a href="/page/ProductDetail" style="float:left" class="btn btn-danger">Cancle </a>
                        </div>
                    </div>
                    <div class="col-3 mt-3">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Save </button>
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

$(document).ready(function() {
    $('#table-load').DataTable();
    $('.multiple-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
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
            url: '/page/ProductDetail/'+id,
            data:formData,
            contentType:false,
            processData:false,
            success: function(res){
                loaderHide();
                if (res.success==false) {
                    $.each(res.errors, function(key, item){
                        ToastMessage("error",item,3000,'top-center');
                    })
                }else{
                    ToastMessage("success","Update Success!",3000,'top-center');
                    $('#UpdateForm')[0].reset();
                    location.href = '/page/ProductDetail'
                }
            },
            error:function (response){
                loaderHide();
                console.log(response);
            }
        });

    })

    $('#PD_image_one').change(function(e){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#PD_image_oneS').attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
	});
    $('#PD_image_two').change(function(e){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#PD_image_twoS').attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
	});
    $('#review_images').change(function(e){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#review_imagesS').attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
	});
    $('#order_image').change(function(e){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#order_imageS').attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
	});

});
</script>
@endpush()