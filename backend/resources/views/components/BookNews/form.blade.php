<div class="row g-3">
    <div class="col-12">
        <x-forms.input :type="'text'" :value="''"  :name="'title'" :label="'Title'" :id="''" :placeholder="'title'" :class="'form-control'" />
    </div>
    
     	
    <div class="col-12">
        @php
            $options = [
                ['id' => 1, 'value' => "Default"],
                ['id' => 2, 'value' => "Slider"]
            ];
        @endphp
        <x-forms.select :options="$options" :selected="1" :ovalue="'id'" :otext="'value'" :name="'show'" :label="' show'" :id="''" :class="'form-control'" />
    </div>


    <div class="col-12">
        @php
            $options = [
                ['id' => 1, 'value' => "Active"],
                ['id' => 0, 'value' => "InActive"]
            ];
        @endphp
        <x-forms.select :options="$options" :selected="''" :ovalue="'id'" :otext="'value'" :name="'status'" :label="' Status'" :id="''" :class="'form-control'" />
    </div>

    <div class="col-12">
        <x-forms.input :type="'file'" :value="''" :name="'image'" :label="' Image'" :id="''" :placeholder="''" :class="'form-control'" />
    </div>

    <div class="col-12">
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Save </button>
        </div>
    </div>
</div>