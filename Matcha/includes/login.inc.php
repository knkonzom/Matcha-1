<?php
date_default_timezone_set('Africa/Johannesburg');
if(isset($_POST['Submit-Login']))
{
    include "../config/database.php";
    $conn = new PDO("mysql:host=$DB_DSN;dbname=matcha2", $DB_USER, $DB_PASSWORD);

    
   
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
                $stmt->execute();
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
                        
                        $date = date('Y-m-d H:i:s');

                        $sql = "SELECT * FROM status WHERE update_userId='{$_SESSION['userId']}' ";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $res = $stmt->fetchColumn();

                        if($res > 0)
                        {
                            $sql = "UPDATE `status` SET `online`= 1, `offline`='{$date}' WHERE update_userId='{$_SESSION['userId']}' ";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                        }
                        else
                        {
                            $sql = "INSERT INTO `status` (update_userId, `online`, `offline`) VALUES ('{$_SESSION['userId']}', 1 , '$date') ";
                            $stmt = $conn->prepare($sql);
                            var_dump($stmt->execute());
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