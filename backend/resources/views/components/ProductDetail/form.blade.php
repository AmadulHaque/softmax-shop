<div class="row g-3">
    
    <div class="col-6">
        @php
            $options = $product;
        @endphp
        <x-forms.select :options="$options" :selected="''" :ovalue="'id'" :otext="'title'" :name="'product_id'" :label="'Product'" :id="''" :class="'form-control'" />
    </div>

    <div class="col-6">
        <x-forms.input :type="'text'" :value="''"  :name="'title'" :label="'Title'" :id="''" :placeholder="'title'" :class="'form-control'" />
    </div>
    <div class="col-6">
        <x-forms.input :type="'text'" :value="''"  :name="'sub_title'" :label="'Sub Title'" :id="''" :placeholder="'Sub Title'" :class="'form-control'" />
    </div>
    <div class="col-6">
        <x-forms.input :type="'text'" :value="''"  :name="'video_one_url'" :label="'video one url'" :id="''" :placeholder="'video one url'" :class="'form-control'" />
    </div>
    <div class="col-6">
        <x-forms.input :type="'text'" :value="''"  :name="'important_title'" :label="'Important Title'" :id="''" :placeholder="'Important Title'" :class="'form-control'" />
    </div>
    <div class="col-6">
        <label class="form-label">PD-important</label>
        <select name="PD_important_id[]" class="multiple-select" data-placeholder="Choose anything" multiple="multiple">
           @foreach ($pdimpotrant as $item)
               <option value="{{ $item->id }}">{{ $item->title }}</option>
           @endforeach
        </select>
    </div>
    <div class="col-6">
        <x-forms.input :type="'text'" :value="''"  :name="'important_desc'" :label="'Important-description'" :id="''" :placeholder="'Important-description'" :class="'form-control'" />
    </div>
    <div class="col-6">
        <x-forms.input :type="'text'" :value="''"  :name="'PD_learn_title'" :label="'PD-Learn-Title'" :id="''" :placeholder="'PD-Learn-Title'" :class="'form-control'" />
    </div>
    <div class="col-6">
        <label class="form-label">PD-Learn</label>
        <select name="PD_learn_id[]" class="multiple-select" data-placeholder="Choose anything" multiple="multiple">
            @foreach ($pdlearn as $item)
                <option value="{{ $item->id }}">{{ $item->title }}</option>
            @endforeach 
        </select>
    </div>
    <div class="col-6">
        <label class="form-label">Gift</label>
        <select name="gift_id" class="form-control"  >
            <option value=""  >-- select --</option>
            @foreach ($gift as $item)
                <option value="{{ $item->id }}">{{ $item->title }}</option>
            @endforeach 
        </select>
    </div>
    <div class="col-6">
        <x-forms.input :type="'file'" :value="''" :name="'PD_image_one'" :label="'PD-Image-One'" :id="''" :placeholder="''" :class="'form-control'" />
    </div>
    <div class="col-6">
        <x-forms.input :type="'file'" :value="''" :name="'PD_image_two'" :label="'PD-Image-Two'" :id="''" :placeholder="''" :class="'form-control'" />
    </div>
    <div class="col-6">
        <x-forms.input :type="'text'" :value="''" :name="'video_two_title'" :label="'Video Two Title'" :id="''" :placeholder="'Video Two Title'" :class="'form-control'" />
    </div>
    <div class="col-6">
        <x-forms.input :type="'text'" :value="''" :name="'video_two_url'" :label="'Video Two url'" :id="''" :placeholder="'Video Two url'" :class="'form-control'" />
    </div>
    <div class="col-6">
        <x-forms.input :type="'text'" :value="''"  :name="'video_desc'" :label="'Video Description'" :id="''" :placeholder="'Video Description'" :class="'form-control'" />
    </div>
    <div class="col-6">
        <x-forms.input :type="'text'" :value="''"  :name="'review_title'" :label="'Video Title'" :id="''" :placeholder="'Video Title'" :class="'form-control'" />
    </div>
    <div class="col-6">
        <x-forms.input :type="'text'" :value="''"  :name="'review_video'" :label="'Review Video'" :id="''" :placeholder="'Review Video'" :class="'form-control'" />
    </div>
    <div class="col-6">
        <x-forms.input :type="'text'" :value="''"  :name="'review_desc'" :label="'Review Description'" :id="''" :placeholder="'Review Description'" :class="'form-control'" />
    </div>
    <div class="col-6">
        <x-forms.input :type="'file'" :value="''" :name="'review_images'" :label="'Review-Image'" :id="''" :placeholder="''" :class="'form-control'" />
    </div>
    <div class="col-6">
        <x-forms.input :type="'text'" :value="''"  :name="'order_title'" :label="'Order Title'" :id="''" :placeholder="'Order Title'" :class="'form-control'" />
    </div>
    <div class="col-6">
        <x-forms.input :type="'file'" :value="''" :name="'order_image'" :label="'Order-Image'" :id="''" :placeholder="''" :class="'form-control'" />
    </div>
    <div class="col-6">
        <x-forms.input :type="'text'" :value="''" :name="'motive_title'" :label="'Motivational-Title'" :id="''" :placeholder="'Motivational-Title'" :class="'form-control'" />
    </div>
    <div class="col-6">
        <x-forms.input :type="'text'" :value="''" :name="'order_video_url'" :label="'Motivational-video-url'" :id="''" :placeholder="'Motivational-Video-url'" :class="'form-control'" />
    </div>
    <div class="col-6">
        <x-forms.input :type="'text'" :value="''" :name="'motive_title_two'" :label="'Motivational-Title-Two'" :id="''" :placeholder="'Motivational-Title-Two'" :class="'form-control'" />
    </div>
    <div class="col-6">
        <label class="form-label">Quotation-Answer</label>
        <select name="qa_id[]" class="multiple-select" data-placeholder="Choose anything" multiple="multiple">
            @foreach ($quationans as $item)
                <option value="{{ $item->id }}">{{ $item->quotaion }}</option>
            @endforeach 
        </select>
    </div>
    <div class="col-6">
        <label class="form-label">Book-Review</label>
        <select name="book_review_id[]" class="multiple-select" data-placeholder="Choose anything" multiple="multiple">
            @foreach ($bookreview as $item)
                <option value="{{ $item->id }}">{{ $item->title }}</option>
            @endforeach 
        </select>
    </div>
    <div class="col-6">
        <x-forms.input :type="'text'" :value="''" :name="'book_news_title'" :label="'Book-News-Title'" :id="''" :placeholder="'Book-News-Title'" :class="'form-control'" />
    </div>
    <div class="col-6">
        <label class="form-label">Book-News</label>
        <select name="book_news_id[]" class="multiple-select" data-placeholder="Choose anything" multiple="multiple">
            @foreach ($booknews as $item)
                <option value="{{ $item->id }}">{{ $item->title }}</option>
            @endforeach 
        </select>
    </div>

    <div class="col-4 m-auto mt-3">
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Save </button>
        </div>
    </div>
</div>