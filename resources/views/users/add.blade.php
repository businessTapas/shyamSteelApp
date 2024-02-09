<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" data-url="{{ route('users.store') }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="userModalTitle">Add User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Form for adding a new user -->
                <form id="addUserForm">
                  <!--   <input type="hidden" id="userId" name="userId"> --> <!-- Hidden field for user ID -->
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required onchange="previewImage()">
                    </div>
                    <div id="imagePreview"class="form-group">

                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>