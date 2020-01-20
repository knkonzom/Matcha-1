<?php

// if(isset($_POST['upload']))
// {
    
//     $upload_dir = 'upload/';
    
//     session_start();
//     $user = $_SESSION['userUid'];
//     $tt = $_SESSION['userEmail'];
//     $userId = $_SESSION['userId'];
    
//     if(empty($_POST['img']))
//     {
//         header("location: UsersProfile.php?error=emptyimage");
//         exit();
//     }
//     else
//     {
       
//         $img = $_POST['img']; // Your data 'data:image/png;base64,AAAFBfj42Pj4';
//         $img = str_replace('data:image/png;base64,', '', $img);
//         $img = str_replace(' ', '+', $img);
//         $data = base64_decode($img);
//         $newdata = mktime().'.jpeg';
//         $file = $upload_dir.mktime().'.jpeg';
//         file_put_contents($file, $data);

//         include "config/database.php";

//         try
//         {    
            
//             $sql = " SELECT * FROM webcamimage";
//             $stmt = $conn->prepare($sql);
//             $result = $stmt->fetch(PDO::FETCH_ASSOC);
//             $setImageOrder = $result + 1;

            
//             $sql = "INSERT INTO webcamimage (update_userId, imgfullNameCam, username, userEmail, likes_count, orderCamImage) VALUES ('{$userId }', '{$newdata}', '{$_SESSION['userUid']}', '{$tt}', 0, '{$setImageOrder}')";
//             $stmt = $conn->prepare($sql);
//             $stmt->execute();
//             file_put_contents($file, $data);

//             $sql2 = "SELECT * FROM webcamimage WHERE username = '$user' ";
//             $stmt2 = $conn->prepare($sql2);
//             $stmt2->execute();
//             if($row = $stmt2->fetch(PDO::FETCH_ASSOC))
//             {
                
//                 $_SESSION['image_usr'] = $row['username']; //image username
//                 $_SESSION['image_name'] = $row['imgfullNameCam']; //image ID name
//                 $_SESSION['image_email'] = $row['userEmail']; // image email
//                 // echo $_SESSION['image_email'];
//                 // exit();
//             }
            
//             header("location: UsersProfile.php?upload=success");
//          }
//         catch(PDOException $e)
//         {
//             echo $e->getMessage();
//         }
//         $conn = null;
//     }
// }
// else 
// {
//     echo "You have an error";
// }


if(isset($_POST['submit']))
{
    session_start();
   $user = $_SESSION['newusername'];
   $tt = $_SESSION['userEmail'];
   $userId = $_SESSION['userId'];

    $newFileName = $_POST['filename'];
   
    $newFileName = strtolower(str_replace(" ", "-", $newFileName));
    
   
    $file = $_FILES['file'];

    $fileName = $file["name"];
    $fileType = $file["type"];
    $fileTempName = $file["tmp_name"];
    $fileError = $file["error"];
    $fileSize = $file["size"];

    $fileExt = explode(".", $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png'); 
   
    if(in_array($fileActualExt, $allowed))
    { 
        if($fileError === 0)
        {
            if($fileSize < 2000000)
            {
                
              $imageFullName = $newFileName . mktime() . "." . $fileActualExt;
            $fileDestination = "upload/" . $imageFullName;

                include "config/database.php";  
                    try
                    {
                        
                        $sql = " SELECT * FROM webcamimage";
                        $stmt = $conn->prepare($sql);
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        $setImageOrder = $result + 1;
                        
                        

                        $sql = "INSERT INTO webcamimage (update_userId, imgfullNameCam, username, userEmail, likes_count, orderCamImage) VALUES ('{$userId }', '{$imageFullName}', '{$_SESSION['userUid']}', '{$tt}', 0, '{$setImageOrder}')";
                        $stmt = $conn->prepare($sql);
                       
                        $stmt->execute();
                        move_uploaded_file($fileTempName, $fileDestination);

                        $sql = " SELECT * FROM webcamimage WHERE imgfullNameCam='{$imageFullName}' ";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                        $_SESSION['image_id'] = $result['idCamImage'];
                        $_SESSION['image_user'] = $result['username'];

                        echo $img = $_SESSION['image_id'];
                        echo $img = $_SESSION['image_user'];
                        echo $result['imgfullNameCam'];
                        header("location: UsersProfile.php?upload=success");
                        
                     }
                    catch(PDOException $e)
                    {
                        echo $e->getMessage();
                    }
                    $conn = null;
                
            }
            else
            {
                echo "File size is too big";
            }
        }
        else{
            echo "You had an error!";
        }
    }
    else
    {
        echo "You need to upload a proper file type!";
        exit();
    }
}
