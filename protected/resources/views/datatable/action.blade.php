<form action="{{ $del_url }}" method="POST">
<a href="{{ $edit_url }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
{{ csrf_field() }}
<input type="hidden" name="_method" value="DELETE">
<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Delete</button>
</form>