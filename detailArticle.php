
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>DemoV2</title>
</head>
<body>
<!--navbar-->

  
<!--navbar-->
<?php  
 session_start();
 $connected=false;
 $admin=0;
 if(isset($_SESSION['user']))
 {
   if(isset($_SESSION['user']['isAdmin']))
   {
    $admin=$_SESSION['user']['isAdmin'];
   }
  
  $connected=true;
 }
 else{
  $connected=false;
 }

?>
  <!--Navbar--->
  <nav class="navbar navbar-expand-lg bg-body-secondary">
  <div class="container-fluid">
   <img src="assets/icons8-logo-64.png" alt="" width="40px;">
    <a class="navbar-brand" href="#">DemoV2</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <?php  
            if($connected)
            {
              ?>
         <?php   if($admin==1){   ?> 
        <li class="nav-item">
       
          <a class="nav-link" href="Admin/home.php">Espace Admin</a>
        </li>
        
        <?php  }?>
        <li class="nav-item">
          <a class="nav-link" href="../utilisateur/readUser.php">My Profile <i class="bi bi-person-badge"></i></a>
        </li>
       
        
        
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout<i class="bi bi-box-arrow-in-right"></i></a>
        </li>
        <?php  } else{ ?>
          <li class="nav-item">
          <a class="nav-link " aria-current="page" href="index.php">Home <i class="bi bi-house-door-fill"></i></a>
        </li>
        <li class="nav-item">
        <a class="nav-link " aria-current="page" href="home.php">Articles <i class="bi bi-bookmark"></i></a>
        </li>
          <li class="nav-item" >
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
        <?php  
           
        }
        ?>
      
      </ul>
      
      
    </div>
  </div>
</nav>
<?php 
  include('./config/pdo.php');
  if(isset($_GET['id']))
  {
    $id=$_GET['id'];
    
    
   
    $query=$db->prepare('SELECT * FROM article  WHERE id =?');
    $query->execute(array($id));
    $articles=$query->fetch();

    $stmt=$db->prepare('SELECT * FROM comments  WHERE article_id =?');
    $stmt->execute(array($id));
    
 
    
    
    if(isset($_SESSION['user']))
    {
     
     
     
        $users=$_SESSION['user'];
        

        foreach($users as $user)
        {
          $user_id=$user['id'];
        }
        
       
       
       
       }
       
     
     
    }

  

?>
<!--endNavbar--->

   <div class="container">

        <div class="card" style="width: 500px;margin-left:400px;margin-top:100px;margin-bottom: 100px;">
         <h1 class="card-title" style="margin-left:10px;margin-top: 50px;"><?php echo $articles['title'];   ?></h1>
            <img src="uploads/<?php echo $articles['image'] ?>" class="card-img-top" alt="..." style="margin-left:;margin-top: 100px;margin-bottom:50px;width: 500px;">
            <div class="card-body text-center">
                
                <p class="card-text"><?php echo $articles['description'];   ?></p>
                <a href="#"><i class="bi bi-people-fill"></i>author id:<?php echo $articles['user_id'];   ?></a><br>
                
            </div>
            <hr>
            <!----comment section---->
            <h5 style="margin-left: 200px;" >Comments :<span id="total_comment"></span>  </h5>
            
             <!-----AddCommentsModal---->
             <!-- Button trigger modal -->
             <?php if(isset($_SESSION['user'])){

              ?>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Comment
          </button>
            <?php } ?>
           <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add comment</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    
                <!-- Modal body -->
                <form method="POST" id="insertForm">
        
                    <div class="mb-3">
                    <div class="form-floating">
                      <textarea class="form-control" placeholder="Leave a comment here"  name="comment"></textarea>
                      <label for="floatingTextarea">commentaire</label>
                    </div>
                    </div>
                    
                    <div class="mb-3">
                      
                      <input hidden type="text" name="user_id" value="<?php echo $user_id  ?>">
                
                    </div>
                    <div class="mb-3">
                      
                      <input hidden type="text"  id="article_id" name="article_id" value="<?php echo $id  ?>">
                
                    </div>
                    
                    <div>
                      <button type="submit" class="btn btn-primary me-1" id="insertBtn">Submit</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
                  </div>
                  <div class="modal-footer">
                    
                  </div>
                </div>
              </div>
            </div>
             <!----endModal----->
            

            <!----end comment section------>
            <span id="comment_id" >
              
            </span>
           
            <span id="comment_id2">
              
            </span>
       </div>
   </div>
    
    </div>
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
   
    <script>
     $(document).ready(function() {

      fetchByArticle();
      
  // function to insert data to database
  $("#insertForm").on("submit", function(e) {
    $("#insertBtn").attr("disabled", "disabled");
    e.preventDefault();
    $.ajax({
      url: "./php/comment/commentRepos.php?action=insertData",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function(response) {
        var response = JSON.parse(response);
        if (response.statusCode == 200) {
          
          $("#insertBtn").removeAttr("disabled");
          $("#insertForm")[0].reset();
          
          
          $("#successToast").toast("show");
          $("#successMsg").html(response.message);
          $('#comment_id').hide();
          fetchByArticle2();
          
        } else if(response.statusCode == 500) {
         
          $("#insertBtn").removeAttr("disabled");
          $("#insertForm")[0].reset();
          
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
 


// function to fetch data from database
function fetchByArticle() {
  var id= $('#article_id').val();
  $.ajax({
    url: './php/comment/commentRepos.php?action=fetchByarticle&param1=' + encodeURIComponent(id) ,
    type: "POST",
    dataType: "json",
    success: function(response) {
      var data = response.data;
     
      $.each(data, function(key, value) {
                          $('#comment_id').append(`
                          <span id="fetch">
                           
                           <span style="margin-left: 50px;">Comment:</span>
                           <p style="margin-left: 100px;">${value.comment}</p>
                           <h6 style="margin-left: 50px;"><i class="bi bi-person"></i>User:${value.user_id}</h6>
                           </span>
                           <hr>
                           
                      `);

                      });
                  }
});
}
});
function fetchByArticle2() {
  var id= $('#article_id').val();
  $.ajax({
    url: './php/comment/commentRepos.php?action=fetchByarticle&param1=' + encodeURIComponent(id) ,
    type: "POST",
    dataType: "json",
    success: function(response) {
      var data = response.data;
     
      $.each(data, function(key, value) {
                          $('#comment_id2').append(`
                           <span id="fetch">
                           <span style="margin-left: 50px;">Comment:</span>
                           <p style="margin-left: 100px;">${value.comment}</p>
                           <h6 style="margin-left: 50px;"><i class="bi bi-person"></i>User:${value.user_id}</h6>
                           </span>
                           <hr>
                           
                      `);

                      });
                  }
});

}

function fetchCount() {
  
  $.ajax({
    url: './php/comment/commentRepos.php?action=fetchCount',
    type: "GET",
    dataType: "json",
    success: function(response) {
      var data = response.data;
      $.each(data, function(key, value) {
                          $('#total_comment').append(`
                           <span id="fetch">
                           <p>${data.id}</p>
                           </span>
                           <hr>
                           
                      `);

                      });
       
                 
      
      }


                  
});

}



    </script>
</body>
</html>