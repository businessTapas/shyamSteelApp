@extends('layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Users')
@section('content')

<div class="container mt-5">
    <h3>User Records</h3>
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addUserModal" id="addUserBtn">Add User</button>
    <table class=" datatable table align-middle table-nowrap table-check" id="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Address</th>
                <th>Gender</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="userTableBody">
            <!-- User records will be inserted here -->
        </tbody>
    </table>
</div>
<script>
        $(document).ready(function() {
            $('#user-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            return '<img src="' + data +
                                '" alt="Logo"  class="img-fluid" style="width:50px">';
                        }
                    },
                     {
                         data: 'address',
                         name: 'address',
                     },
                     {
                         data: 'gender',
                         name: 'gender'
                     },
                     {
                         data: 'action',
                         name: 'action',
                         orderable: false,
                         searchable: false,
                     },
                ]
            });
        });
    </script>
  
@include('users.add')

     {{-- -------------------------------------------View Mdal------------------------ --}}
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="view_modal" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">View User</h5>
                <button type="button" class="btn-close" data-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>
            <div class="modal-body" id="view_modal_body">
               
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    {{-- ---------------------- View Mdal End------------------------------------------------------------- --}}
    
    {{-- -------------------------------------------Edit Mdal------------------------ --}}
    <div class="modal fade " id="edit_modal"  data-url="{{ route('users.update') }}">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Edit User Details</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="edit_modal_body">
                   
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    
    {{-- ---------------------- Edit Mdal End------------------------------------------------------------- --}}
   

@endsection

