<?php
include('./config/pdo.php');

$query = $db->query("SELECT a.id,a.title,a.description,a.image,u.name,u.email 
FROM article a ,user u WHERE a.user_id=u.id and isActif=1");
$result =$query->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $res)
{
   
    echo'<div class="container" style="width: 700px;">'; 
    echo'<div class="row" style="margin-top: 20px;">'; 
    
    echo '<div class="col-sm-6 mb-3 mb-sm-0">';
    echo "<div class='card' style='width: 18rem;margin-top: 20px;margin-left: 50px;'>";
    
    echo' <img src="uploads/'.$res['image'].'" class="card-img-top" alt="..."  style="width: 400px;">';
    echo '<h5 class="card-title" style="width:800px;margin-left:10px">'.$res['title'].'</h5>';
    
    echo '<a href="detailArticle.php?id='.$res['id'].'" class="btn btn-primary" style="width: 400px;">See More..</a>';
    echo "</div>";
    echo "</div>";
    
    echo'</div>'; 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p style="width: 50px;"></p>
     <!----Bootstrap-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <!-- Jquery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Datatables  -->
  <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
  <!-- JS  -->
 
  <script>
      // function to fetch data for home page
     $(document).ready(function () {
        
       
         
        
        
     });
    
     
          
  </script>
</body>
</html>