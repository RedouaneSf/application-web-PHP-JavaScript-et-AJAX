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
<?php  
 session_start();
 $connected=false;
 $admin=0;
 if(isset($_SESSION['user']))
 {
   if($_SESSION['user']['isAdmin'])
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
          <a class="nav-link" href="../auth/logout.php">Logout<i class="bi bi-box-arrow-in-right"></i></a>
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
<!--endNavbar--->
    
    <div class="container">
         
    </div>
    <div class="container2">
         
    </div>
    
</body>
</html>

 


  <!-- Bootstrap  -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <!-- Jquery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Datatables  -->
  <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
  <!-- JS  -->
 
  <script>
      // function to fetch data for home page
     $(document).ready(function (){
        load();
        setInterval(function(){
            $('.container').load("fetch.php").fadeIn('slow');
           console.log("10 seconds have passed!");
           $('.container2').hide();
         },10000);
         
         
         

        
     });
     function load()
     {
      $('.container2').load("fetch.php").fadeIn('slow');
     }
     
          
  </script>