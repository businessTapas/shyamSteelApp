<button type="button" class="btn btn-primary btn-sm edit-button" value="{{$item['id']}}" data-id="{{$item['id']}}"  onclick="editForm('{{ route('users.show', $item['id']) }}','view_modal_body')"
                data-target="#view_modal" data-toggle="modal">
    <i class="fas fa-edit"></i><span> View </span>
</button>
<button type="button" class="btn btn-primary btn-sm edit-button" value="{{$item['id']}}" data-id="{{$item['id']}}"  onclick="editForm('{{ route('users.edit', $item['id']) }}','edit_modal_body')"
                data-target="#edit_modal" data-toggle="modal">
    <i class="fas fa-edit"></i><span> Edit </span>
</button>

<button type="button" class="btn btn-danger btn-sm tooltip1" onclick="delete_entity('{{ route('users.destroy',$item['id']) }}')" data-id="{{$item['id']}}">
    <i class="fas fa-trash-alt"></i><span>Delete</span>
</button>

