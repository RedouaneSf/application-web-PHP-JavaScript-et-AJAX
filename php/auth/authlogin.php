<?php
include_once('../../config/db_conn.php');
/****************login************************ */
session_start();

$email = mysqli_real_escape_string($conn, $_POST['email']);
$pwd = md5(mysqli_real_escape_string($conn, $_POST['pwd']));

$select_query = mysqli_query($conn, "select * from user where email='$email' and password='$pwd'");
$row = mysqli_num_rows($select_query);
if($row>0)
{
	$rows=mysqli_fetch_assoc($select_query);
	
    
	$_SESSION['user'] = $rows;
	if(isset($_SESSION['user']))
	{
		$isAdmin=$_SESSION['user']['isAdmin'];

		if($isAdmin==1)
		{
			
			header('location:../espaceAdmin/home.php');
		}
		else
		{
            echo json_encode(array("status"=>1, "msg"=>"Login Successful!User"));
		}
	}
    
   
    
	
}
else
{
	echo json_encode(array("status"=>0, "msg"=>"Wrong Credentials!"));
}