<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EspaceAdmin</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <!-- Font Awesome  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Datatables CSS  -->
  <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet" />
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
      $isAdmin=$dt['isAdmin'];
      $name=$dt['name'];
  }
  
  
 }


?>
  <nav class="navbar justify-content-center fs-3 mb-3" style="background-color:#00ff5573;">Espace Admin</nav>

  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <div class="text-body-secondary">
        <span class="h5">All Users</span>
        <br>
        Manage all your existing users or add a new on
        
        <h3>Welcom<?php echo $name;  ?></h3>
        
       
       
      </div>
    
      
     
    </div>
    
    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-bottom: 20px;">
    <i class="fa-solid fa-user-plus fa-xs"></i>
     Add user
   </button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add User information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" id="insertForm">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Nikola">
          </div>
         
         
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email" placeholder="name@example.com">
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" class="form-control" name="password">
        </div>
        </div>
        <div class="mb-3">
          
     
        </div>
        
        <div style="
    margin-bottom: 20px;
    margin-left: 20px;">
          <button type="submit" class="btn btn-primary me-1" id="insertBtn">Submit</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
     
    </div>
  </div>
</div>
<div class="container">
    <table class="table table-bordered table-striped table-hover align-middle" id="myTable" style="width:100%;">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>name</th>
          <th>email</th>
           <th>Actions</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
</div>

  <!--------editModal---------->
                <!-- Button trigger modal -->


                <!-- Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User Info</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form method="POST" id="editForm">
                                    <input type="hidden" name="id" id="id">
                                    <div class="row mb-3">
                                      <div class="col">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" >
                                      </div>
                                      
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label">Email</label>
                                      <input type="email" class="form-control" name="email" >
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label">Password</label>
                                      <input type="password" class="form-control" name="password" >
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
  <script src="../../public/js/user.js"></script>
  
</body>

</html>