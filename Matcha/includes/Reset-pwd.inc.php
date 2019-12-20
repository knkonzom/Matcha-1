<?php
    
    if(isset($_POST['reset-password-submit']))
    {
        
        $selector = $_POST["selector"];
        $validator = $_POST["validator"];
        $password = $_POST["pwd"];
        $passwordRepeat = $_POST["pwd-repeat"];

        if(empty($password) || empty($passwordRepeat))
        {
            header("location: ../Create-new-pwd.php?newpwd=empty");
            exit();
        }
        else if ($password != $passwordRepeat)
        {
            
             header("location: ../Create-new-pwd.php?newpwd=pwdnotsame");
        }
        $currentDate = date("U");
    
        include "../config/database.php";

        $sql = " SELECT * FROM pwdreset WHERE pwdResetSelector=? AND pwdResetExpire >= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $selector); 
        $stmt->bindParam(2, $currentDate); 
        $stmt->execute();

        if($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {

            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

            if($tokenCheck === false)
            {
                echo "You need to re-submit your reset request.";
                exit();
            }
            else if($tokenCheck === true)
            {
                $tokenEmail = $row['pwdResetEmail'];
           
                $sql = "SELECT * FROM users WHERE usersEmail=?;";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $tokenEmail); 
                $stmt->execute();

                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $sql = "UPDATE users SET usersPassword=? WHERE usersEmail=?";
                $stmt = $conn->prepare($sql);
                $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
                $stmt->bindParam(1, $newPwdHash); 
                $stmt->bindParam(2, $tokenEmail); 
                $stmt->execute();

                $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $tokenEmail);
                $stmt->execute();
                 header("location: ../resetpassword.php?newpwd=passwordupdated");
            }
            else
            {
                echo "You still need to re-submit your reset request.";
                exit();
            }
        }
    }
    else
    {
        
         header("location: ../index.php");
    }
?>
