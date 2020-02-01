<?php
session_start();
include "config/database.php";
if( isset($_POST['value']))
{
    $interest = implode(' ', $_POST['value']);
    echo "$interest";

    $sql = "UPDATE profileupdate SET Interest='{$interest}' WHERE update_userId='{$_SESSION['userId']}' ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}
?>
    
