<?php
include('../../config/db_conn.php');
// function to fetch data by list
if ($_GET["action"] === "fetchDataTitle") {
    if(isset($_POST['request'])){
     
      $id=$_POST['request'];
    
    $sql = "SELECT a.id,a.title,a.description,a.image,u.name,u.email 
    FROM article a ,user u WHERE a.user_id=u.id and  u.isActif=1 AND a.id='$id'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
   
  }
  }

?>
<table class="table">
    <?php  
      if($count){
    ?>
   <thead>
      <tr>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Image</th>                
      </tr>
   </thead>
  <?php  
      }else
      {
        echo "Sorry! not Found";
      }
  ?>

  <tbody>
    <?php while($row= mysqli_fetch_assoc( $result)){ ?>
                         <tr>
                            <td> <?php echo $row['id']; ?></td>
                            <td> <?php  echo $row['title']; ?></td>
                            <td> <?php  echo $row['description']; ?></td>
                            <td> <img src="../../uploads/<?php   echo $row['image']; ?>" alt="" width="50px;"></td>
                        </tr>
         <?php }  ?>
  </tbody>
</table>