<div class="row g-3">
    <div class="col-12">
    <x-forms.input :type="'text'" :value="''"  :name="'name'" :label="'Category Name'" :id="''" :placeholder="'name'" :class="'form-control'" />
    </div>
    
    <div class="col-12">
        @php
            $options = $categorys;
        @endphp
        <x-forms.select :options="$options" :selected="''" :ovalue="'id'" :otext="'name'" :name="'parent_category'" :label="'Parent Category '" :id="''" :class="'form-control'" />
    </div>

    <div class="col-12">
        @php
            $options = [
                ['id' => 1, 'value' => "One"],
                ['id' => 0, 'value' => "Two"]
            ];
        @endphp
        <x-forms.select :options="$options" :selected="''" :ovalue="'id'" :otext="'value'" :name="'category_style'" :label="'Category Style'" :id="''" :class="'form-control'" />
    </div>

    <div class="col-12">
        @php
            $options = [
                ['id' => 1, 'value' => "Active"],
                ['id' => 0, 'value' => "InActive"]
            ];
        @endphp
        <x-forms.select :options="$options" :selected="''" :ovalue="'id'" :otext="'value'" :name="'status'" :label="'Category Status'" :id="''" :class="'form-control'" />
    </div>

    <div class="col-12">
        <x-forms.input :type="'file'" :value="''" :name="'image'" :label="'Category Image'" :id="''" :placeholder="''" :class="'form-control'" />
    </div>

    <div class="col-12">
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Save Category</button>
        </div>
    </div>
</div>