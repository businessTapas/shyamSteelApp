$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

      // Function to add a new user
  $("#addUserForm").submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    var url = $('#addUserModal').data('url');
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        success: function(response){
            console.log(response);
            //Swal.fire("Success!", response.message, "success");
            alert(response.message);
            $("#addUserForm").trigger('reset');
            $('#imagePreview img').remove(); // Set image preview to blank
            $('#addUserModal').modal('hide');
            $('.datatable').DataTable().ajax.reload();
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            //swal("Error!", error, "error");
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

 // Function to update user
 // used to render data for view and edit modal
    $(document).on('submit', '#editUserForm', function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        var url = $('#edit_modal').data('url');
        alert(url);
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function(response){
                // Handle response
                console.log(response);
                //Swal.fire("Success!", response.message, "success");
                alert(response.message);
                $("#editUserForm").trigger('reset');
                $('#edit_modal').modal('hide');
                // Reload the table
                $('.datatable').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                //swal("Error!", error, "error");
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
  
  
});

// Function to preview image
function previewImage() {
    const fileInput = document.getElementById("image");
    const file = fileInput.files[0];
    const reader = new FileReader();

    reader.onload = function(event) {
        const imageUrl = event.target.result;        
         //$('#imagePreview').attr('src', imageUrl);

         const imageElement = document.createElement("img");
        imageElement.src = imageUrl;
        imageElement.alt = "Image Preview";
        imageElement.style.maxWidth = "100px"; // Set maximum width
        imageElement.style.maxHeight = "100px"; // Set maximum height
        imagePreview.innerHTML = "";
        imagePreview.appendChild(imageElement); 
    };

    if (file) {
        reader.readAsDataURL(file);
    }
}


function delete_entity(url, targetId)
{
    if (confirm("Are you sure to Delete?")) {
        $.ajax({
            url: url,
            type: 'DELETE',
           
            success: function(response) {
                // Handle the response here, e.g., update button text or styles
                // $('#'+targetId).html(response);
                //swal("Success!", response.message, "success");
                alert(response.message);
                $('.datatable').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                //swal("Error!", error, "error");
            }
        });
    }
}

// used to render data for view and edit modal
function editForm(url_name, target_id, method = "GET", table_id = "") {
    // preloader("", target_id);
   // getting the button of the form and passing into the preloader function
   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function () {
     if (this.readyState == 4 && this.status == 200) {
       document.getElementById(target_id).innerHTML = this.responseText;
    // stopPreloader("", target_id);
     }
   };
   if (table_id != "") {
     url_name = url_name + "?id=" + table_id;
   }
   xhttp.open(method, url_name, true);
   xhttp.send();
 }

