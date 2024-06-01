<?php 
include_once('../../config/db_conn.php');

/****************register************************ */
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['emailid']);
  $pwd = md5(mysqli_real_escape_string($conn, $_POST['pwd']));
 

  $insert_query = mysqli_query($conn,"insert into user set name='$name', email='$email', password='$pwd'");
  if($insert_query>0)
  {
    echo "Registration successfull!";
  }
  else
  {
    echo "Error!";
  }

/****************login************************ */
session_start();

$lemail = mysqli_real_escape_string($conn, $_POST['email']);
$lpwd = md5(mysqli_real_escape_string($conn, $_POST['pwd']));

$select_query = mysqli_query($conn, "select * from user where email='$lemail' and password='$lpwd'");
$row = mysqli_num_rows($select_query);
if($row>0)
{
	$fetch_data = mysqli_fetch_assoc($select_query);

	echo json_encode(array("status"=>1, "msg"=>"Login Successful!"));
  $isAdmin=0;
                  
                  $_SESSION['user'] =$fetch_data;
                   
                    $isAdmin= $_SESSION['user']['isAdmin'];  
                  
                  if($isAdmin==1)
                  {
                    //Set session variables
                    header('Location:./Admin/profile.php');
                  }
                  else
                  {
                     header('Location:./User/profile.php');
                  }
}
else
{
	echo json_encode(array("status"=>0, "msg"=>"Wrong Credentials!"));
}


function check_input($data)
{
   $data=trim($data);
   $data=stripslashes($data);
   $data=htmlspecialchars($data);
   return $data;
}