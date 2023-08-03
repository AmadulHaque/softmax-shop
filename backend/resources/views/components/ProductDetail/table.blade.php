<table id="table-load" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Title</th>
            <th>Action</th>
        </tr>
    </thead> 	 	 	
    <tbody>
        @foreach ($datas as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>
                    <a href="/page/ProductDetail/{{ $item->id }}" class="btn btn-sm btn-outline-success edit"  ><i class="fadeIn animated bx bx-edit-alt"></i></a>
                    <button type="button" class="btn btn-sm btn-outline-danger  remove" data-id="{{ $item->id }}" ><i class="fadeIn animated bx bx-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>