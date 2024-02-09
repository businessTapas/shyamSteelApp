@extends('layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Users')
@section('content')

<div class="container mt-5">
    <h2>User Records</h2>
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

@include('users.add')

@endsection

