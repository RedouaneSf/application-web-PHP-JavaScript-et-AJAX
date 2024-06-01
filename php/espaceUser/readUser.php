<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <title>DemoV2</title>
</head>
<?php include('../includes/navbar.php'); ?>


<?php 
 
if(isset($_SESSION['user']))
{
 
  $id=0;
  $data =$_SESSION['user'];
  foreach($data as $dt)
  {
      $id=$dt['id'];
  }
  $utilisateurs= getUserByID($id);
}
 
  else
  {
    echo "access denied";
  }
  function getUserByID($id)
  {

    include('../../config/pdo.php'); 
      $stmt=$db;
       
       $query=$stmt->prepare('SELECT * FROM user Where id = ?');
       $query->execute(array($id));
      
       return $query;
    }
?>
<div class="container py-2">
 
<?php   foreach($utilisateurs as $utilisateur){

    ?>
  <div class="card" style="width: 500px;
    margin-left: 300px;">
            <div class="card-header">
            My informations
            </div>
            <div class="card-body">
                <label for="">Name</label>
                <h5 class="card-title"><?php   echo $utilisateur['name'];  ?></h5>
                <label for="">Email</label>
                <p class="card-text"><?php   echo $utilisateur['email'];  ?></p>
                
                <div class="card-btn" style="margin-left: 100px;">

                        <a href="./updateUser.php?id=<?php echo $utilisateur['id']; ?>"class="btn btn-primary">Update <i class="bi bi-clipboard-plus-fill"></i></a>
                        <a href="./deleteUser.php?id=<?php  echo $utilisateur['id']; ?>" class="btn btn-danger" onclick="return confirm('Do you want delete this profile? ');">Delete profile <i class="bi bi-x-circle-fill"></i></a>
                </div>
            </div>
        </div>
  <?php
}   

?>
        
</div>
    
</body>
</html>