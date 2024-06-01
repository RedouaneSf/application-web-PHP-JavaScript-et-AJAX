<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>DemoV2</title>
</head>

<?php include('../includes/navbar.php'); 


if(isset($_SESSION['user']))
{
   $isAdmin=0;
   $name=0;
   $data=$_SESSION['user'];
   foreach($data as $dt)
   {
       $isAdmin=$dt['isAdmin'];
       $name=$dt['name'];
   }

   if($isAdmin==1)
   {
       echo("<h1  style='color:grey;margin-left:500px; margin-top:50px;margin-bottom:50px;
   '> Welcome :" .$name. "</h1>");
   }
   
}
else{
   header('location:../login.php'); 
}

?>





 <!--container-->
       <div class="container">
         <div class="row row-cols-1 row-cols-md-2 g-4">
        <!---profile card--->
                 <div class="col">
                    <div class="card mb-3" style="max-width: 500px;height: 200px;">
                            <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="../../assets/unauthorized-person.png" class="img-fluid rounded-start" alt="user.png">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">My Profile</h5>
                                            
                                            <a  href="./readUser.php"><button type="submit" class="btn btn-primary btn-lg my-2" name="ajouter">Plus....</button></a> 
                                        </div>
                                    </div>
                            </div>
                    </div>
                 </div>    
         <!---end profile card--->  
          <!---profile article--->
          <div class="col">
                    <div class="card mb-3" style="max-width: 500px;height: 200px;">
                                <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="../../assets/man.png" class="img-fluid rounded-start" alt="user.png">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">List of Users</h5>
                                                
                                                <a href="../user/user.php"><button type="submit" class="btn btn-info btn-lg my-4" name="ajouter">Plus...</button></a>
                                            </div>
                                        </div>
                                </div>
                    </div>
        </div>
         <!---end profile article---> 
         <!---profile article--->
         <div class="col">
                    <div class="card mb-3" style="max-width: 500px;height: 200px;">
                                <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="../../assets/article.png" class="img-fluid rounded-start" alt="user.png" style="margin-top: 10px;">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"> Articles</h5>
                                                
                                                <a href="../article/article.php"><button type="submit" class="btn btn-info btn-lg my-4" name="ajouter">Plus...</button></a>
                                            </div>
                                        </div>
                                </div>
                    </div>
        </div>
        <div class="col">
                    <div class="card mb-3" style="max-width: 500px;height: 200px;">
                                <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="../../assets/comments.png" class="img-fluid rounded-start" alt="user.png" style="margin-top: 10px;">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">Comments</h5>
                                                
                                                <a href="../comment/comment.php"><button type="submit" class="btn btn-info btn-lg my-4" name="ajouter">Plus...</button></a>
                                            </div>
                                        </div>
                                </div>
                    </div>
        </div>
         <!---end profile article--->  

            
         </div>        
    </div>    

<!--endcontainer--->
</body>
</html>