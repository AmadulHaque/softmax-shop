<div class="row g-3">
    <div class="col-12">
    <x-forms.input :type="'text'" :value="''"  :name="'quotaion'" :label="'Quotaion'" :id="''" :placeholder="'Quotaion'" :class="'form-control'" />
    </div>
    <div class="col-12">
        <label for="">Answer</label>
        <textarea name="ans" id="" class="form-control"  cols="2" rows="2"></textarea>
    </div>
    <div class="col-12">
        @php
            $options = [
                ['id' => 1, 'value' => "Active"],
                ['id' => 0, 'value' => "InActive"]
            ];
        @endphp
        <x-forms.select :options="$options" :selected="''" :ovalue="'id'" :otext="'value'" :name="'status'" :label="'Status'" :id="''" :class="'form-control'" />
    </div>
    <div class="col-12">
        <div class="d-grid">
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </div>
</div>