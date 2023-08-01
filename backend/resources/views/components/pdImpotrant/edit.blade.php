<form id="UpdateForm" data-id="{{ $data->id }}" method="post">
    @csrf
    @method('put')
    <input type="hidden" name="id" value="{{ $data->id }}">
    <div class="row g-3">
        <div class="col-12">
            <x-forms.input :type="'text'" :value="$data->title" :name="'title'" :label="'title'" :id="''" :placeholder="''" :class="'form-control'" />
        </div>
        <div class="col-12">
            @php
                $options = [
                    ['id' => 1, 'value' => "Active"],
                    ['id' => 0, 'value' => "InActive"]
                ];
            @endphp
            <x-forms.select :options="$options" :selected="$data->status" :ovalue="'id'" :otext="'value'" :name="'status'" :label="' Status'" :id="''" :class="'form-control'" />
        </div>
        <div class="col-12">
            <div class="d-grid">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
    
</form>