

<div>
    <label class="form-label">{{ $label }}</label>
    <select name="{{ $name }}"    class="{{ $class }}" id="{{ $id }}" >
        <option value=""  selected >--  select --</option>
        @foreach ($options as $item)
            <option {{ $selected==$item[$ovalue] ? "selected" : " " }} value="{{ $item[$ovalue] }}">{{ $item[$otext] }}</option>
        @endforeach
    </select>
</div>
