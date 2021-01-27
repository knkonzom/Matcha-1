<?php

    include '../config/database.php';
    $conn = new PDO("mysql:host=$DB_DSN;dbname=matcha2", $DB_USER, $DB_PASSWORD);


    $sql = "SELECT UsersId FROM users WHERE token = ? AND verified = '0' ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $_GET['code']);
    $stmt->execute();
    $num = $stmt->rowCount();

    if($num > 0)
    {
        $sql = " UPDATE users SET verified = '1' WHERE token = :token";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':token', $_GET['code']);
        if($stmt->execute())
        {
            header("location: ../index.php?activate=success");
            exit();
        }
        else
        {
            echo "<div>Unable to update verification code.</div>";
            //print_r($stmt->errorInfo());
        }
    }
    else
    {
        // tell the user he should not be in this page
        echo "<div>We can't find your verification code.</div>";
    }
?>