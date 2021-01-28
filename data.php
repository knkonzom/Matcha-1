<?php
session_start();
if(!$_SESSION)
{
    header("location: index.php?error=needtologin");
}else if($_SESSION['userId']){
include "config/database.php";
$conn = new PDO("mysql:host=$DB_DSN;dbname=matcha2", $DB_USER, $DB_PASSWORD);

if( isset($_POST['value']))
{
    $interest = implode(' ', $_POST['value']);
    echo "$interest";

    $sql = "UPDATE profileupdate SET Interest='{$interest}' WHERE update_userId='{$_SESSION['userId']}' ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}
}
?>
    
