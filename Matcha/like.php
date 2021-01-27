<?php

include "config/database.php";
$conn = new PDO("mysql:host=$DB_DSN;dbname=matcha2", $DB_USER, $DB_PASSWORD);

session_start();
if(!$_SESSION)
{
    header("location: index.php?error=needtologin");
}else {

echo $id = $_SESSION['pro_id'];

if(isset($_POST['likeit']))
{ 
  
      $messege =  $_SESSION['userUid']." "."like your Profile";
      try
      {
        
        $id = intval($id);

        $sql = "SELECT * FROM notification WHERE receiver_id=$id AND message='$messege' ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $row = $stmt->rowCount();
        
        if($row > 0 )
        {
          header("location:  UsersProfile.php?alread=like");
          exit();
        }
        else{
          $sql = "INSERT INTO notification (`receiver_id`, message, read_n) VALUES ($id, '$messege', 1)";
          $stmt = $conn->prepare($sql);
          $stmt->execute();

          header("location: UsersProfile.php?success=like");
        }
      }
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }
}
}
?> 