<a href="print-pdf/{{ $id }}" target="_blank" data-toggle="tooltip"
    class="edit btn btn-info edit btn-sm">
    Print
</a>
<a href="order-edit/{{$id}}"  data-toggle="tooltip" data-original-title="Edit"
    class="edit btn btn-success edit btn-sm">
    Edit
</a>
<a href="javascript:void(0);" id="delete-compnay" onClick="deleteFunc({{ $id }})" data-toggle="tooltip"
    data-original-title="Delete" class="delete btn btn-danger btn-sm">
    Delete
</a>
