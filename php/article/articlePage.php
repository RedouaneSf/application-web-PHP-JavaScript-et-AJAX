<?php
include('../../config/db_conn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DemoV2</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Font Awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Datatables CSS  -->
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS  -->
    <link rel="stylesheet" href="../../public/css/style.css">
        <style type="text/css">
          body{
            margin: 0;
            padding: 0;
            font-family: "Helvetica",sans-serif;
          }
          #filers{
            margin-left: 10%;
            margin-top: 2%;
            margin-bottom: 2%;
          }
        </style>
</head>
<body>
  <?php  include('../includes/navbar.php') ?>
    <div id="filters">
        <select name="fetchval" id="fetchval" style="margin-left: 500px;
  margin-bottom: 50px;
  margin-top: 50px;
  width: 400px;
  height: 50px;
  background-color: ghostwhite;">
            <span>Fetch results</span>
            <option value="" disabled="" selected="">Select Article</option>
            <?php $query="SELECT a.id,a.title,a.description,a.image,u.name,u.email 
              FROM article a ,user u WHERE a.user_id=u.id and  u.isActif=1";
                      $r=mysqli_query($conn,$query);
                      while($row= mysqli_fetch_assoc($r)){?>
            <option value="<?php echo $row['id']?>"><?php echo $row['title']?></option>
            <?php  }?>
        </select>

    </div>
    <div class="container">
            <table class="table">
                     <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                        </tr>
                     </thead>
                     <?php $query="SELECT a.id,a.title,a.description,a.image,u.name,u.email 
              FROM article a ,user u WHERE a.user_id=u.id and  u.isActif=1";
                      $r=mysqli_query($conn,$query);
                      while($row= mysqli_fetch_assoc($r)){

                     
                     ?>
                     <tbody>
                        <tr>
                            <td> <?php echo $row['id']; ?></td>
                            <td> <?php  echo $row['title']; ?></td>
                            <td> <?php  echo $row['description']; ?></td>
                            <td> <img src="../../uploads/<?php   echo $row['image']; ?>" alt="" width="50px;"></td>
                        </tr>
                        <?php }  ?>
                     </tbody>
            </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <!-- Jquery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Datatables  -->
  <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
  <script type="text/javascript">
      $(document).ready(function(){
          $('#fetchval').on('change',function(){
            var value = $(this).val();
            
            $.ajax({
                type: "POST",
                url: "fetchArticle.php?action=fetchDataTitle",
                data: 'request='+value,
                success:function(data)
                {
                    $(".container").html(data);
                }
            });
          });
      });
  </script>
</body>
</html>