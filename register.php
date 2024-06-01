<?php
  
  session_start();
  $isAdmin=0;
  $connected=false;
  if(isset($_SESSION['user']))
  {
   
   
       $users=$_SESSION['user'];
       $connected=true;

       foreach($users as $user)
       {
           $isAdmin= $user['isAdmin'];
       }
   
   
  }
  
  else{
   $connected=false;
  }
  if(isset($_POST['register']))
  {   $userName=$_POST['name'];
      $email=$_POST['email'];
      $password=$_POST['password'];
      $Cpassword=$_POST['password2'];
      if($password==$Cpassword)
      {
        register($userName,$email,$password);
      }
      else
      {
        echo "check your password";
      }
     
     
  }
  /*  register function */
  function register($name,$email,$password)
  {
    include('./config/pdo.php');
   $query=0;
   $db =$db;
   if(!empty($email) && !empty($password) && !empty($name))
   {
     // Check if the email already exists in the database.
     $stmt = $db->prepare("SELECT email FROM user WHERE email = ?");
     
     $stmt->execute(array($email));
     $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($data != NULL) {
           // If email already exists, return an error message.
           
           $msg="Email already exists";
            echo $msg="Email already exists";
        }
        else
        {  // Validate email format.
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              if (preg_match("/([<|>])/", $email)) {
                 // If disallowed characters are found, 
                 // return an error message.
              
                 $msg= "< and > characters are not allowed";
                 echo "< and > characters are not allowed";
             }
               // If email is not valid, return an error message.
               $msg="Email is not valid";
               echo "Email is not valid";
               
           }
           else
           {
              if (preg_match("/([<|>])/",$name)) {
                 // If disallowed characters are found, 
                 // return an error message.
              
                 $msg= "< and > characters are not allowed";
                 echo "< and > characters are not allowed";
             }else
             {

             
              $query= $db->prepare('INSERT INTO user (name,email,password) values(?,?,?)');
              $hashed_password = password_hash($password, PASSWORD_DEFAULT);
              $query->execute([$name,$email,$hashed_password]);
              if($query)
              {
              
              echo "Registration successfully go to login page";
              }
              else
              {
              
              echo "error";
              }
          
               }  
           }
        }

     }

           
           
   else
   {
       $msg="remplir tous les champs";
       echo "remplir tous les champs";
   }
   
  
   

   return $query;


  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./public/css/authStyle.css">
    <title>register</title>
</head>
<body>
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
              <?php   if($isAdmin==1){   ?> 
        <li class="nav-item">
       
          <a class="nav-link" href="../admin/home.php">Espace Admin</a>
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
<div class="container" id="register-container">
  <h3 id="register-title">Register</h3>
    <!--register form-->
      <form method="post" action="">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">User Name</label>
              <input type="text" class="form-control" id="exampleInputEmail1" name="name">
            
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="text" class="form-control" id="exampleInputEmail1" name="email">
            
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Confirme Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="password2">
            </div>
            <p id="p-link">You have already account <a href="login.php">login</a></p>
            <button type="submit" class="btn btn-primary" name="register" id="register-btn">Register</button>
      </form>
      <!--end register form-->
   </div>
</body>
</html>