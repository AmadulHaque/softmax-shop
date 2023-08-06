
<div class="col-lg-8">
    <div class="border border-3 p-4 rounded">
        <div class="mb-3">
            <x-forms.input :type="'text'" :value="''"  :name="'title'" :label="'Product Title'" :id="''" :placeholder="'Title'" :class="'form-control'" />
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Summery</label>
            <textarea name="summery"  class="form-control"  cols="5" rows="5"></textarea>
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea name="description" id="editor" cols="2" rows="2"></textarea>
        </div>
        <div class="mb-3">
            <x-forms.input :type="'file'" :value="''"  :name="'thumbnail'" :label="'Product Thumbnail'" :id="'thumbnail'" :placeholder="''" :class="'form-control'" />
            <img id="shoThumbnail" style="width:100px" src="">
        </div>
        <div class="mb-3">
            <label  class="form-label">Product Images</label>
            <input id="image-uploadify" class="form-control" name="images[]" type="file" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" multiple>
        </div>

        <div class="mb-3">
            <x-forms.input :type="'text'" :value="''"  :name="'meta_title'" :label="'Meta Title'" :id="''" :placeholder="'Meta Title'" :class="'form-control'" />
        </div>
        <div class="mb-3">
            
            <label for="inputProductTags" class="form-label">Product Tags</label>
            <input type="text" class="form-control" name="meta_keyword" id="inputProductTags" data-role="tagsinput" placeholder="Enter Meta Key">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Meta Description</label>
            <textarea name="meta_desc"  class="form-control"  cols="5" rows="5" placeholder="Meta Description"></textarea>
        </div>

    </div>
</div>

<div class="col-lg-4">
    <div class="border border-3 p-4 rounded">
        <div class="row g-3">
            <div class="col-md-6">
                <x-forms.input :type="'number'" :value="''"  :name="'price'" :label="'Product Price'" :id="''" :placeholder="'00.00'" :class="'form-control'" />
            </div>
            <div class="col-md-6">
                <x-forms.input :type="'number'" :value="''"  :name="'offer_price'" :label="'Offer Price'" :id="''" :placeholder="'00.00'" :class="'form-control'" />
            </div>
            {{-- <div class="col-md-6"> --}}
                {{-- <x-forms.input :type="'number'" :value="''"  :name="'qty'" :label="'Quantity'" :id="''" :placeholder="'Quantity..!'" :class="'form-control'" /> --}}
            {{-- </div> --}}
            <div class="col-md-6">
                @php
                    $options = $units;
                @endphp
                <x-forms.select :options="$options" :selected="''" :ovalue="'id'" :otext="'name'" :name="'unit_id'" :label="'Unit'" :id="''" :class="'form-control'" />
            </div>
            <div class="col-12">
                <label for="inputProductTags" class="form-label">Product Size</label>
                <input type="text" class="form-control" name="size" id="inputProductTags" data-role="tagsinput" >
            </div>
            <div class="col-12">
                <label for="inputProductTags" class="form-label">Product color</label>
                <input type="text" class="form-control" name="color" id="inputProductTags" data-role="tagsinput" >
            </div>
            <div class="col-12">
                @php
                    $options =$categorys;
                @endphp
                <x-forms.select :options="$options" :selected="''" :ovalue="'id'" :otext="'name'" :name="'category_id'" :label="'Category'" :id="''" :class="'form-control'" />
            </div>
            <div class="col-12">
                @php
                    $options = $brands;
                @endphp
                <x-forms.select :options="$options" :selected="''" :ovalue="'id'" :otext="'name'" :name="'brand_id'" :label="'Brand'" :id="''" :class="'form-control'" />
            </div>
            <div class="col-12">
                <label for="inputProductTags" class="form-label">Product Tags</label>
                <input type="text" class="form-control" name="tags" id="inputProductTags" data-role="tagsinput" placeholder="Enter Product Tags">
            </div>

            <div class="col-12">
                <div class="form-check  form-switch">
                    <input type="hidden"  name="trending" value="0">
                    <input class="form-check-input cursor-pointer" type="checkbox" id="trending" name="trending" value="1">
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
                <x-forms.select :options="$options" :selected="''" :ovalue="'id'" :otext="'value'" :name="'status'" :label="'Product Status'" :id="''" :class="'form-control'" />
            </div>

            <div class="col-12">
                <div class="d-grid">
                    <button class="btn btn-success">Save Product</button>
                </div>
            </div>
        </div> 
    </div>
</div>