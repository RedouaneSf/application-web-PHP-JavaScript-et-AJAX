<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Demov2</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <!-- Font Awesome  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Datatables CSS  -->
  <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- CSS  -->
  <link rel="stylesheet" href="../../public/css/style.css">
</head>

<body>
<?php include('../includes/navbar.php') ?>
  <?php



if(isset($_SESSION['user']))
 {
  
  $data=$_SESSION['user'];
  foreach($data as $dt)
  {
    $id=$dt['id'];
      
      $name=$dt['name'];
  }
  
  
 }


?>
  <nav class="navbar justify-content-center fs-3 mb-3" style="background-color:#00ff5573;"> User Space</nav>

  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <div class="text-body-secondary">
        <span class="h5">All Articles</span>
        <br>
        Manage all your existing users or add a new on
      </div>
      <!-- Button to trigger Add user offcanvas -->
      
     
    </div>
    
    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <i class="fa-solid fa-user-plus fa-xs"></i>
     Add Article
   </button>
   <input type="text" class="form-control" id="id"  value="<?php echo $id ?>" hidden>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Article information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" id="insertForm">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" placeholder="Ex:Nikola">
          </div>
          <div class="col">
            
            <input type="text" class="form-control" name="id"  value="<?php echo $id ?>" hidden>
          </div>
        </div>
        <div class="mb-3">
        <div class="form-floating">
          <textarea class="form-control" placeholder="Leave a comment here"  name="description"></textarea>
          <label for="floatingTextarea">Description</label>
        </div>
        </div>
        <div class="row mb-3">
          <label class="form-label">Upload Image</label>
          <div class="col-2">
            <img class="preview_img" src="../../images/default_profile.jpg">
          </div>
          <div class="col-10">
            <div class="file-upload text-secondary">
              <input type="file" class="image" name="image" accept="image/*">
              <span class="fs-4 fw-2">Choose file...</span>
              <span>or drag and drop file here</span>
            </div>
          </div>
        </div>
        <div class="mb-3">
          
     
        </div>
        
        <div>
          <button type="submit" class="btn btn-primary me-1" id="insertBtn">Submit</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
     
    </div>
  </div>
</div>
    
    <table class="table table-bordered table-striped table-hover align-middle" id="myTable" style="width:100%;">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>title</th>
          <th>description</th>
          <th>image</th>
         
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
  <!--------editModal---------->
                <!-- Button trigger modal -->


                <!-- Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Article Info</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form method="POST" id="editForm">
                                    <input type="hidden" name="id" id="id">
                                    <div class="row mb-3">
                                      <div class="col">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="title" >
                                      </div>
                                      
                                    </div>
                                    <div class="mb-3">
                                    <div class="form-floating">
                                      <textarea class="form-control" placeholder="Leave a comment here"  name="description"></textarea>
                                      <label for="floatingTextarea">Description</label>
                                    </div>
                                    </div>
                                    <div class="row mb-3">
                                      <label class="form-label">Upload Image</label>
                                      <div class="col-2">
                                        <img class="preview_img" src="images/default_profile.jpg">
                                      </div>
                                      <div class="col-10">
                                        <div class="file-upload text-secondary">
                                          <input type="file" class="image" name="image" accept="image/*">
                                          <input type="hidden" name="image_old" id="image_old">
                                          <span class="fs-4 fw-2">Choose file...</span>
                                          <span>or drag and drop file here</span>
                                        </div>
                                      </div>
                                    </div>
                                    
                                    
                                    <div>
                                      <button type="submit" class="btn btn-primary me-1" id="editBtn">Update</button>
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                  </form>
                        </div>
                    </div>
                </div>
                <!---------endEditModal---------------->


               



 
  <!-- Toast container  -->
  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <!-- Success toast  -->
    <div class="toast align-items-center text-bg-success" role="alert" aria-live="assertive" aria-atomic="true" id="successToast">
      <div class="d-flex">
        <div class="toast-body">
          <strong>Success!</strong>
          <span id="successMsg"></span>
        </div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
    <!-- Error toast  -->
    <div class="toast align-items-center text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true" id="errorToast">
      <div class="d-flex">
        <div class="toast-body">
          <strong>Error!</strong>
          <span id="errorMsg"></span>
        </div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>


  <!-- Bootstrap  -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <!-- Jquery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Datatables  -->
  <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
  <!-- JS  -->
  <script>
    $(document).ready(function() {
  // call fetchData function
  fetchData();


  //initialize datatables
  let table = new DataTable("#myTable");


  // function to display image before upload
  $("input.image").change(function() {
    var file = this.files[0];
    var url = URL.createObjectURL(file);
    $(this).closest(".row").find(".preview_img").attr("src", url);
  });


  
   // function to fetch data from database
   function fetchData() {
    var id = $('#id').val();
    $.ajax({
      url:'./articleRepos.php?action=fetchDataByUser&param3=' + encodeURIComponent(id),
      type: "POST",
      dataType: "json",
      success: function(response) {
        var data = response.data;
        table.clear().draw();
        $.each(data, function(index, value) {
          table.row.add([
            value.id,
            value.title,
            value.description,
            
            '<img src="../../uploads/' + value.image + '" style="width:50px;height:50px;border:2px solid gray;border-radius:8px;object-fit:cover">',
            
            '<Button href="" class="btn btn-info  editUser" data-bs-toggle="modal" data-bs-target="#editModal" value="' + value.id + '">EDIT</Button>'+
            '<Button type="button" class="btn deleteBtn" value="' + value.id + '"><i class="fa-solid fa-trash fa-xl"></i></Button>' +
            '<input type="hidden" class="delete_image" value="' + value.image + '">',
          ]).draw(false);
        })
      }
    })
  }

  // function to insert data to database
  $("#insertForm").on("submit", function(e) {
    $("#insertBtn").attr("disabled", "disabled");
    e.preventDefault();
    $.ajax({
      url: "./articleRepos.php?action=insertData",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function(response) {
        var response = JSON.parse(response);
        if (response.statusCode == 200) {
          $("#offcanvasAddUser").offcanvas("hide");
          $("#insertBtn").removeAttr("disabled");
          $("#insertForm")[0].reset();
          $(".preview_img").attr("src", "../../images/default_profile.jpg");
          
          $('#exampleModal').modal('hide');
          $("#successToast").toast("show");
          $("#successMsg").html(response.message);
          fetchData();
        } else if(response.statusCode == 500) {
          $("#offcanvasAddUser").offcanvas("hide");
          $("#insertBtn").removeAttr("disabled");
          $("#insertForm")[0].reset();
          $(".preview_img").attr("src", "../../images/default_profile.jpg");
          $("#errorToast").toast("show");
          $("#errorMsg").html(response.message);
        } else if(response.statusCode == 400) {
          $("#insertBtn").removeAttr("disabled");
          $("#errorToast").toast("show");
          $("#errorMsg").html(response.message);
        }
      }
    });
  });
  // function to delete data
  $("#myTable").on("click", ".deleteBtn", function() {
    if(confirm("Are you sure you want to delete this user?")) {
      var id = $(this).val();
      var delete_image = $(this).closest("td").find(".delete_image").val();
      $.ajax({
        url: "./articleRepos.php?action=deleteData",
        type: "POST",
        dataType: "json",
        data: {
          id,
          delete_image
        },
        success: function(response) {
          if(response.statusCode == 200) {
            fetchData();
            $("#successToast").toast("show");
            $("#successMsg").html(response.message);
          } else if(response.statusCode == 500) {
            $("#errorToast").toast("show");
            $("#errorMsg").html(response.message);
          }
        }
      })
    }
  })
  // function to edit data
  $("#myTable").on("click", ".editUser", function() {
    var id = $(this).val();
    $.ajax({
      url: "./articleRepos.php?action=fetchSingle",
      type: "POST",
      dataType: "json",
      data: {
        id: id
      },
      success: function(response) {
        var data = response.data;
        $("#editForm #id").val(data.id);
        $("#editForm input[name='title']").val(data.title);
        $("#editForm textarea[name='description']").val(data.description);
        $("#editForm .preview_img").attr("src", "../../uploads/" + data.image + "");
        $("#editForm #image_old").val(data.image);
       
      }
    });
  });

  // function to update data in database
  $("#editForm").on("submit", function(e) {
    $("#editBtn").attr("disabled", "disabled");
    e.preventDefault();
    $.ajax({
      url: "./articleRepos.php?action=updateData",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function(response) {
        var response = JSON.parse(response);
        if (response.statusCode == 200) {
          
          $("#editBtn").removeAttr("disabled");
          $("#editForm")[0].reset();
          $(".preview_img").attr("src", "../../images/default_profile.jpg");
          
          $("#successToast").toast("show");
          $("#successMsg").html(response.message);
          fetchData();
        } else if(response.statusCode == 500) {
          
          $("#editBtn").removeAttr("disabled");
          $("#editForm")[0].reset();
          $(".preview_img").attr("src", "../../images/default_profile.jpg");
          $("#errorToast").toast("show");
          $("#errorMsg").html(response.message);
        } else if(response.statusCode == 400) {
          $("#editBtn").removeAttr("disabled");
          $("#errorToast").toast("show");
          $("#errorMsg").html(response.message);
        }
      }
    });
  });

  

});
  </script>

</body>

</html>