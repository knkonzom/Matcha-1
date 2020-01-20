<?php

if(isset($_POST['Submit-Login']))
{
    include "../config/database.php";
    
   
    $mailuid = htmlspecialchars($_POST['login_user']);
    $password = htmlspecialchars($_POST['login_pwd']);
    
    if(empty($mailuid) || empty($password) )
    {
        header("location: ../index.php?error=emptyfields");
    }
    else
    {
        
        try
        {
                 $sql = "SELECT * FROM users WHERE username=? OR usersEmail=?;";
                
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $mailuid);
                $stmt->bindParam(2, $mailuid);
                var_dump($stmt->execute());
                if($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    
                    $pwdcheck = password_verify($password, $row['usersPassword']);
                    if($pwdcheck == false)
                    {
                        header("location: ../index.php?error=wrongpwd");
                    }
                    else if($pwdcheck == true)
                    {
                        session_start();
                        $_SESSION['userId'] = $row['UsersId'];
                        $_SESSION['userUid'] = $row['username'];
                        $_SESSION['userEmail'] = $row['usersEmail'];
                        $_SESSION['verify'] = $row['verified'];
                        if($row['verified'] == 0)
                        {
                            header("location: ../index.php?error=notverified");
                            exit();
                        }
                    
                        header("location: ../UsersProfile.php?login=loginsuccess");
                    }
                    else
                    {
                        header("location: ../index.php?error=wrongpwd");
                    }
                }
                else
                {
                    if($row['username'] !== $mailuid)
                    {
                        header("location: ../index.php?error=nouser");
                    }
                }
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    $conn = null;

}