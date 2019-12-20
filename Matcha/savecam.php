<?php

if(isset($_POST['upload']))
{
    
    $upload_dir = 'upload/';
    
    session_start();
    $user = $_SESSION['userUid'];
    $tt = $_SESSION['userEmail'];
    $userId = $_SESSION['userId'];
    
    if(empty($_POST['img']))
    {
        header("location: HomePage.php?error=emptyimage");
        exit();
    }
    else
    {
       
        $img = $_POST['img']; // Your data 'data:image/png;base64,AAAFBfj42Pj4';
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $newdata = mktime().'.jpeg';
        $file = $upload_dir.mktime().'.jpeg';
        file_put_contents($file, $data);

        include "config/database.php";

        try
        {    
            
            $sql = " SELECT * FROM webcamimage";
            $stmt = $conn->prepare($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $setImageOrder = $result + 1;

            
            $sql = "INSERT INTO webcamimage (update_userId, imgfullNameCam, username, userEmail, likes_count, orderCamImage) VALUES ('{$userId }', '{$newdata}', '{$user}', '{$tt}', 0, '{$setImageOrder}')";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            file_put_contents($file, $data);

            $sql2 = "SELECT * FROM webcamimage WHERE username = '$user' ";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->execute();
            if($row = $stmt2->fetch(PDO::FETCH_ASSOC))
            {
                
                $_SESSION['image_usr'] = $row['username']; //image username
                $_SESSION['image_name'] = $row['imgfullNameCam']; //image ID name
                $_SESSION['image_email'] = $row['userEmail']; // image email
                // echo $_SESSION['image_email'];
                // exit();
            }
            
            header("location: UsersProfile.php?upload=success");
         }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        $conn = null;
    }
}
else 
{
    echo "You have an error";
}
