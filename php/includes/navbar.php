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
       

    ?>
  <!--Navbar--->
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <img src="../../assets/icons8-logo-64.png" alt="" width="40px;">
   <a class="navbar-brand" href="../../index.php">DemoV2</a>
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
       
          <a class="nav-link" href="../espaceAdmin/home.php">Espace Admin <i class="bi bi-clipboard2-data-fill"></i></a>
        </li>
        <li class="nav-item">
       
       <a class="nav-link" href="../article/articlePage.php">List of Articles <i class="bi bi-chat-right-text"></i></a>
     </li>
        
        <?php  }?>
        <li class="nav-item">
          <a class="nav-link" href="../espaceAdmin/readUser.php">My Profile <i class="bi bi-person-badge"></i></a>
        </li>
        <?php   if($isAdmin==0){   ?>
        <li class="nav-item">
          <a class="nav-link" href="../espaceUser/home.php">Dashboard <i class="bi bi-clipboard2-data-fill"></i></i></a>
        </li>
        <?php } ?>
        
        <li class="nav-item">
          <a class="nav-link" href="../../logout.php">Logout<i class="bi bi-box-arrow-in-right"></i></a>
        </li>
        
        <?php  } else{ ?>
          <li class="nav-item">
          <a class="nav-link " aria-current="page" href="../index.php">Home <i class="bi bi-house-door-fill"></i></a>
        </li>
        
          <li class="nav-item" >
          <a class="nav-link" href="../login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../register.php">Register</a>
        </li>
        <?php  
           
        }
        ?>
      
      
      
    </div>
  </div>
</nav>
<!--endNavbar--->