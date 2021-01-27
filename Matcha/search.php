<?php
session_start();

include "config/database.php";
$conn = new PDO("mysql:host=$DB_DSN;dbname=matcha2", $DB_USER, $DB_PASSWORD);


if(isset($_POST['SearchUser']))
{
    $username = $_POST['search'];
   

    if(empty($username))
    {
        echo "empty search";
    }
    else
    {
        try
        {
            $sql ="SELECT * FROM users WHERE username = '$username'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $res = $stmt->rowCount();
              
            if($res > 0)
            {     
                
                    $sql ="SELECT * FROM users WHERE username = '$username'";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                 
                    if($res = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        
                        $_SESSION['publicprofile'] = $res['username'];
                         $_SESSION['update_id'] = $res['UsersId'];
                        
                    }

                    $sql ="SELECT * FROM profileupdate WHERE username = '$username'";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    if($res = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        $_SESSION['about'] = $res['AboutMe'];
                        $_SESSION['gender'] = $res['Gender'];
                        $_SESSION['sexpref'] = $res['sexualPreference'];
                    
                    }
                    header("location: PublicProfile.php?$username=userprofile");
                    exit();
            }
            else
            {
                header("location: index.php?$username=namedoesnotexist");
                exit();
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}
?>