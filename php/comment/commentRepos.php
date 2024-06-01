<?php
include "../../config/db_conn.php";

// function to fetch data
if ($_GET["action"] === "fetchData") {
  $sql = "SELECT * FROM comments";
  $result = mysqli_query($conn, $sql);
  $data = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  mysqli_close($conn);
  header('Content-Type: application/json');
  echo json_encode([
    "data" => $data
  ]);
}

// function to fetch data
if ($_GET["action"] === "fetchCount") {
  $sql = "SELECT count(id) FROM comments ";
  $result = mysqli_query($conn, $sql);
  $data = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  mysqli_close($conn);
  header('Content-Type: application/json');
  echo json_encode([
    "data" => $data
  ]);
}
// function to fetch data by article
if ($_GET['action']=== "fetchByarticle") {
  if(isset($_GET['param1']))
  {
    $id=$_GET['param1'];
  }
  $sql = "SELECT * FROM comments Where article_id=$id";
  $result = mysqli_query($conn, $sql);
  $data = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  mysqli_close($conn);
  header('Content-Type: application/json');
  echo json_encode([
    "data" => $data
  ]);
}

// insert data to database
if ($_GET["action"] === "insertData") {
  if (!empty($_POST["comment"])  ) {
    $comment = mysqli_real_escape_string($conn, $_POST["comment"]);
    $user_id =  $_POST["user_id"];
    $article_id =$_POST["article_id"];
    

    $sql = "INSERT INTO `comments`(`id`, `comment`,`user_id`,`article_id`) VALUES (NULL,'$comment','$user_id','$article_id')";

    if (mysqli_query($conn, $sql)) {
      echo json_encode([
        "statusCode" => 200,
        "message" => "Data inserted successfully 😀"
      ]);
    } else {
      echo json_encode([
        "statusCode" => 500,
        "message" => "Failed to insert data 😓"
      ]);
    }
  } else {
    echo json_encode([
      "statusCode" => 400,
      "message" => "Please fill all the required fields 🙏"
    ]);
  }
}
// function to delete data
if ($_GET["action"] === "deleteData") {
  $id = $_POST["id"];
  

  $sql = "DELETE FROM comments WHERE `id`=$id";

  if (mysqli_query($conn, $sql)) {
    // remove the image
    
    echo json_encode([
      "statusCode" => 200,
      "message" => "Data deleted successfully 😀"
    ]);
  } else {
    echo json_encode([
      "statusCode" => 500,
      "message" => "Failed to delete data 😓"
    ]);
  }
}

// fetch data of individual user for edit form
if ($_GET["action"] === "fetchSingle") {
  $id = $_POST["id"];
  $sql = "SELECT * FROM comments WHERE `id`=$id";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    header("Content-Type: application/json");
    echo json_encode([
      "statusCode" => 200,
      "data" => $data
    ]);
  } else {
    echo json_encode([
      "statusCode" => 404,
      "message" => "No user found with this id 😓"
    ]);
  }
  mysqli_close($conn);
}

// function to update data
if ($_GET["action"] === "updateData") {
  if (!empty($_POST["comment"])) {
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $comment = mysqli_real_escape_string($conn, $_POST["comment"]);
    
  

    
    $sql = "UPDATE `comments` SET `comment`='$comment' WHERE `id`=$id";
    if (mysqli_query($conn, $sql)) {
      echo json_encode([
        "statusCode" => 200,
        "message" => "Data updated successfully 😀"
      ]);
    } else {
      echo json_encode([
        "statusCode" => 500,
        "message" => "Failed to update data 😓"
      ]);
    }
    mysqli_close($conn);
  } else {
    echo json_encode([
      "statusCode" => 400,
      "message" => "Please fill all the required fields 🙏"
    ]);
  }
}
