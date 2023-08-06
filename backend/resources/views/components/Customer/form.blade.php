<div class="row g-3">
    <div class="col-12">
        <x-forms.input :type="'text'" :value="''"  :name="'name'" :label="'Customer Name'" :id="''" :placeholder="'name'" :class="'form-control'" />
    </div>
    <div class="col-12">
        <x-forms.input :type="'email'" :value="''"  :name="'email'" :label="'Customer email'" :id="''" :placeholder="'email'" :class="'form-control'" />
    </div>
    <div class="col-12">
        <x-forms.input :type="'number'" :value="''"  :name="'mobile_no'" :label="'Customer Mobile'" :id="''" :placeholder="'mobile_no'" :class="'form-control'" />
    </div>
    <div class="col-12">
        <x-forms.input :type="'text'" :value="''"  :name="'address'" :label="'Customer address'" :id="''" :placeholder="'address'" :class="'form-control'" />
    </div>
    <div class="col-12">
        @php
            $options = [
                ['id' => 1, 'value' => "Active"],
                ['id' => 0, 'value' => "InActive"]
            ];
        @endphp
        <x-forms.select :options="$options" :selected="''" :ovalue="'id'" :otext="'value'" :name="'status'" :label="'Unit Status'" :id="''" :class="'form-control'" />
    </div>

    <div class="col-12">
        <div class="d-grid">
            <button type="submit" class="btn btn-success">Save </button>
        </div>
    </div>
</div>