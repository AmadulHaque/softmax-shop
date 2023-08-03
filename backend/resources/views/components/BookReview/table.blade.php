<table id="table-load" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Video</th>
            <th>Ratting</th>
            <th>Image</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead> 	 	 	
    <tbody>
        @foreach ($datas as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>{{ $item->desc }}</td>
                <td>{{ $item->video }}</td>
                <td>{{ $item->ratting }}</td>
                <td style="width:73px" >
                    <img class="rounded " src="{{ asset($item->image) }}"  style="width:100%"  alt="">
                </td>
                <td>
                    @if ($item->status==1)
                        <span class="active-bg" ><i class="lni lni-checkmark-circle"></i></span>
                    @else
                        <span class="inactive-bg"><i class="lni lni-cross-circle"></i></span>
                    @endif
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-outline-success edit" data-id="{{ $item->id }}" ><i class="fadeIn animated bx bx-edit-alt"></i></button>
                    <button type="button" class="btn btn-sm btn-outline-danger  remove" data-id="{{ $item->id }}" ><i class="fadeIn animated bx bx-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>