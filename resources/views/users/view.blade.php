<form id="viewUserForm"  >
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
                        <label for="gender">Gender: {{$user['gender']}}</label>
                       
                    </div>
                    
                    <div id="imagePreview"class="form-group">
                    <img src="{{ asset($user['image']) }}"  style="max-width: 100px; " alt = "Image Preview">

                    </div>
                </form>