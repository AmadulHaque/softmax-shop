<div class="row g-3">
    <div class="col-12">
        <x-forms.input :type="'text'" :value="''"  :name="'title'" :label="'Title'" :id="''" :placeholder="'title'" :class="'form-control'" />
    </div>
    
   
    <div class="col-12">
        <x-forms.input :type="'text'" :value="''"  :name="'desc'" :label="'Description'" :id="''" :placeholder="'desc'" :class="'form-control'" />
    </div>
    <div class="col-12">
        <x-forms.input :type="'text'" :value="''"  :name="'video'" :label="'video'" :id="''" :placeholder="'video'" :class="'form-control'" />
    </div>
     	
    <div class="col-12">
        @php
            $options = [
                ['id' => 1, 'value' => "1 star"],
                ['id' => 2, 'value' => "2 star"],
                ['id' => 3, 'value' => "3 star"],
                ['id' => 4, 'value' => "4 star"],
                ['id' => 5, 'value' => "5 star"]
            ];
        @endphp
        <x-forms.select :options="$options" :selected="''" :ovalue="'id'" :otext="'value'" :name="'ratting'" :label="' Ratting'" :id="''" :class="'form-control'" />
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