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
       

    

      if(isset($_POST['login']))
      {
        $email=$_POST['email'];
        $password=$_POST['password'];

        login($email, $password);
      }
       ////////////////////////////////
   /*  login function   */
   function login($email, $password) {
    // Establish a database connection.
    include('./config/pdo.php');
    $mysqli = $db;
    $data=0;
    // Trim leading and trailing whitespaces 
    // from username and password.
    $email = trim($email);
    $password = trim($password);
 
    // Check if either username or password is empty.
    if ($email == "" || $password == "") {
        $msg= "Both fields are required";
        echo "Both fields are required";
    }
 
    // Sanitize username and password to prevent SQL injection.
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $password = filter_var($password, FILTER_UNSAFE_RAW);
 
    // Prepare SQL statement to select username 
    // and password from users table.
    

 
    // Check if the username exists in the database.
    if(!empty($email) && !empty($password))
    {
       $stmt = $mysqli->prepare("SELECT id,name,email ,password,isAdmin,isActif FROM user WHERE email = ?");
       // Execute the prepared statement to query the database.
       $stmt->execute(array($email));
       // Fetch the associative array representing the first
       // row of the result set.
       $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
       if ($data == NULL) {
          
          
          echo "Wrong EMAIL or password";
       }
       else
       {
          $pwd=0;
          foreach($data as $dt)
          {
             $pwd=$dt['password'];
          }
          if (password_verify($password,$pwd) == FALSE) {
             
             
             echo  "Wrong EMAIL or password";
          } else {
             
             // If authentication is successful, 
             // set the user session and redirect to account page.
                $isAdmin=0;
                session_start();
                $_SESSION['user'] =$data;

                foreach($data as  $dt)
                {
                  $isAdmin=$dt['isAdmin'];  
                }
                if($isAdmin==1)
                {
                  //Set session variables
                  header('Location:php/espaceAdmin/home.php');
                }
                else
                {
                   header('Location:php/espaceUser/home.php');
                }
               
      
          }
    }
 }
 
    // Verify the provided password against the 
    // hashed password in the database.
    
    return $data;
 }
////////////////////////////////
 /*  login function   */
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
    <link rel="stylesheet" href="public/style/messageStyle.css">
    <title>Login</title>
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
   <div class="container" id="login-container">
    <!--login form-->
    <h3  id="login-title">Login</h3>
      <form method="post" action="">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" name="email">
            
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <p>You are not a member? <a href="register.php">register</a></p>
            <button type="submit" class="btn btn-primary" name="login" id="btn-login">Login</button>
      </form>
      <!--end login form-->
   </div>
</body>
</html>