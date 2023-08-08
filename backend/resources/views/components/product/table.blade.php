<table id="table-load" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Title</th>
            <th>Thumbnail</th>
            <th>Category</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Offer-P</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td style="width:50px" >
                    <img class="rounded " src="{{ asset($item->thumbnail) }}"  style="width:50px"  alt="">
                </td>
                <td>{{ $item->category->name }}</td>
                <td>{{ $item->brand->name }}</td>
                <td>{{ $setting->currency }} {{ $item->price }}</td>
                <td>{{ $setting->currency }} {{ $item->offer_price }}</td>
                <td>
                    @if ($item->status==1)
                        <span class="active-bg" ><i class="lni lni-checkmark-circle"></i></span>
                    @else
                        <span class="inactive-bg"><i class="lni lni-cross-circle"></i></span>
                    @endif
                </td>
                <td>
                    <a href="/page/product/{{ $item->id }}"  class="btn btn-sm btn-outline-success" ><i class="fadeIn animated bx bx-edit-alt"></i></a>
                    <button type="button" class="btn btn-sm btn-outline-danger  remove" data-id="{{ $item->id }}" ><i class="fadeIn animated bx bx-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>