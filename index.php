<?php 
  include('./config/pdo.php'); 

  $q=$db->query("SELECT a.id,a.title,a.description,a.image,u.name,u.email 
  FROM article a ,user u WHERE a.user_id=u.id and u.isActif=1");
 
  //pagination
  if(isset($_GET['page']))
{
  $page=$_GET['page'];
}
  
  if(empty($_GET['page']))
  {
    $page=1;
  }
  $cpt=$q->rowCount();
  $nbr_elements_par_page=3;
  $nbr_de_page=  ceil($cpt/$nbr_elements_par_page);
  $debut=($page-1)*$nbr_elements_par_page;
   
  $query=$db->query("SELECT a.id,a.title,a.description,a.image,u.name,u.email 
  FROM article a ,user u WHERE a.user_id=u.id and isActif=1 Limit {$debut},{$nbr_elements_par_page} ");
  $id=0;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
<!--endNavbar--->

<?php  
if ($query->rowCount() >0) {

    
  $articles=$query->fetchAll(PDO::FETCH_ASSOC);
  if(count($articles)==0)
  {
           echo "not found";
  }
  
}
else
{
echo "no article";
}

?>
<div class="container" style="margin-top: 50px;width:700px;" >


<?php  
if(isset($articles))
{


foreach($articles as $article)  {

?>
<div class="card">
  <div class="card-pic" data-mdb-ripple-init data-mdb-ripple-color="light">
   <img src="uploads/<?php echo $article['image'] ?>" alt="pic"  style="max-width: 800px;
  
  margin-bottom: 10px;
  " class="card-img-top">
    <hr>
    <a href="#!">
      <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
    </a>
  </div>
  <div class="card-body">
    <h3 class="card-title px-4" style="margin-left:10px;"  data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="fetch()">
    <?php echo $article['title']; ?></h3>
    <input  hidden class="id" type="text" id="id" value="<?php echo $article['id']; ?>">
    
    <p class="card-text"><small class="text-body-secondary">created by:<i class="bi bi-person"></i><a href="Article/articleByUser.php?name=<?php echo  $article['name'];?>"><?= $article['name']?></a></small></p>
    <a href="detailArticle.php?id=<?php echo $article['id']; ?>" class="btn btn-secondary" style="width: -webkit-fill-available;">plus...</a>
   
  </div>
 
</div>
<br>
<?php }   ?>
<!--end card--->
<!--pagination-->
<div class="pagination" style="margin-bottom: 50px; margin-left:200px;">

    <?php 
       for($i=1;$i<=$nbr_de_page;$i++)
       {
        ?>
        <?php  if($page!=$i)
        {?>
         <a href="?page=<?php echo $i ?>"   style="margin-right: 5px;" class="btn btn-dark active"><?php echo $i;  ?><span>&nbsp</span></a>
        <?php }else{?>
          <a href="" class="btn btn-dark" style="margin-right: 5px;"><?php echo $i;  ?><span>&nbsp</span></a>
          <?php
        }
        ?>
        
      <?php }
}
    ?>
</div>
<!--endpagination-->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Article Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="body">

        

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
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
      // function to fetch data for home page
     
      $(document).ready(function(){
             
             $('.id').on('click',function(){
                
                let id=$(this).val();
                $.ajax({
      url:'./php/article/articleRepos.php?action=fetchByTitle&param01=' + encodeURIComponent(id) ,
      type: "POST",
      dataType: "json",
      success: function(response) {
        var data = response.data;
        
        $.each(data, function(index, value) {
          $('#body').append(`<h1>Title</h1><hr><h1>${value.title}</1><br><hr>
          <img src="uploads/${value.image}" alt="" style="width: 300px;" > <br> <hr>
          <h1>Description</h1><br> <p>${value.description}</p> <br><hr>
          <a href="detailArticle.php?id=${value.id}" class="btn btn-secondary" style="width: -webkit-fill-available;">plus...</a>
          

          `);
          
          
        })
      }
    })
             })
             

      }); 
     ////////////////////////////////////////
      // function to fetch data from database
  function fetch() {
    let id=$('#id').val();
    $.ajax({
      url:'./php/article/articleRepos.php?action=fetchByTitle&param01=' + encodeURIComponent(id) ,
      type: "POST",
      dataType: "json",
      success: function(response) {
        var data = response.data;
        
        $.each(data, function(index, value) {
          $('#body').append(`<h1>Title</h1><hr><h1>${value.title}</1><br><hr>
          <img src="uploads/${value.image}" alt="" style="width: 300px;" > <br> <hr>
          <h1>Description</h1><br> <p>${value.description}</p> <br><hr>
          <a href="detailArticle.php?id=${value.id}" class="btn btn-secondary" style="width: -webkit-fill-available;">plus...</a>
          

          `);
          
          
        })
      }
    })
  }
     
          
  </script>
  
</body>
</html>