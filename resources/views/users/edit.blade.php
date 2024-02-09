<form id="editUserForm" >
    
                     <input type="hidden" id="userId" value="{{$user['id']}}" name="userId">  <!-- Hidden field for user ID -->
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$user['name']}}" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{$user['address']}}" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="Male" {{ $user['gender'] == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $user['gender'] == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" class="form-control-file" id="image" name="image" accept="image/*"  onchange="previewImage()">
                    </div>
                    <div id="imagePreview"class="form-group">
                    <img src="{{ asset($user['image']) }}"  style="max-width: 100px; " alt = "Image Preview">

                    </div>
                    <button  name="submit" class="btn btn-primary">Submit</button>
                </form>
