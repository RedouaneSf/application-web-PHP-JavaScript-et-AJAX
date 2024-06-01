<?php

session_start();

  $isAdmin=0;
    

    if(isset($_GET['id']) && !empty($_GET['id'])){

        $id=$_GET['id'];
        $data=$_SESSION['user'];
        foreach($data as $dt)
        {
            $isAdmin= $dt['isAdmin'];
        }

        if($isAdmin==1)
        {
            $query=deleteUser($id);
            if($query)
            {
                header('location:../espaceAdmin/home.php');
                
            }
            else
            {
                echo"error";   
            }
        }
        else
        {
            $query=deleteUser($id);
            header('location:../../register.php');
            

        }
        
    }
    function deleteUser($id)
   {
    include('../../config/pdo.php');
    $bannirUser=0;
    $id= $_GET['id'];
    $status=0;
    $stmt=$db;
    $recupUser= $stmt->prepare('SELECT * FROM user where id =?');
    $recupUser->execute(array($id));
    if($recupUser->rowCount()>0){
        $bannirUser=$db->prepare('UPDATE user  SET isActif =?  WHERE id =?');
        $bannirUser->execute(array($status,$id));
        $deleteArticles=$db->prepare('DELETE FROM article WHERE user_id =?');
        $deleteArticles->execute(array($id));
        
        echo "user deleted";
     }
     else
     {
        
        echo "not found";
     }
    return  $bannirUser;
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
    <title>Delete User</title>
</head>
<body>
    <h1>delete normale</h1>
</body>
</html>