<?php

if(isset($_POST['Submit-SignUp']))
{
   include '../config/database.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $first_name = $_POST['FirstName'];
    $last_name = $_POST['LastName'];
    $password = $_POST['Password'];
    $passwordRepeat = $_POST['Repeat-password'];

    
    if(empty($username) || empty($email) || empty($first_name) || empty($last_name) || empty($password) || empty($passwordRepeat))
    {
        
        header("location: ../index.php?error=emptyfields&username=".$username."&email=".$email);
    
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username) )
    {
        header("location: ../index.php?error=invaliduidmail");
        
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        header("location: ../index.php?error=invalidmail&username=".$username);
        
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        header("location: ../index.php?error=invalidmail&username=".$email);
        
    }
    else if ($password !== $passwordRepeat)
    {
        header("location: ../index.php?error=passwordcheck&username=".$username."&email=".$email);
    
    }
    // else if(strlen($password) < 8 )
    // {
    //     header("location: ../index.php?error=passwordlen&username=".$username."&email=".$email);
    //     exit();
    // }
    // else if(!preg_match("/[A-Z]/", $password))
    // {
    //     header("location: ../index.php?error=passwordCAP&username=".$username."&email=".$email);
    //     exit();
    // }
    // else if(!preg_match("/[0-9]/", $password))
    // {
    //     header("location: ../index.php?error=passwordNUM&username=".$username."&email=".$email);
    //     exit();
    // }
    else 
    {
       
        try 
        {
            
            
             $sql = "SELECT count(*) FROM users WHERE username=? OR usersEmail=? AND verified = '0'";
           
             $stmt = $conn->prepare($sql);

             $stmt->bindParam(1, $username);
             $stmt->bindParam(2, $email);
            var_dump($stmt->execute());
            $result = $stmt->fetchColumn();

            if($result > 0)
            {  
                
                $sql = "SELECT * FROM users WHERE username=? OR usersEmail=? AND verified = '0' ";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $username);
                $stmt->bindParam(2, $email);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result['username'] == "$username")
                {   
                    header("location: ../index.php?error=usertaken&email=".$username);
                    
                }
                else if($result['usersEmail'] == "$email")
                {   
                    header("location: ../index.php?error=emailtaken&email=".$email);
                
                }
                else
                {
                    // you have to create a resend verification script
                    
                    echo "<div>Your email is already in the system but not yet verified.</div>";
                }   
            }
            else
            {
                
                
                $token =  bin2hex(random_bytes(50));
                $verificationLink = "http://localhost:8080/Matcha/includes/activate.inc.php?code=".$token;
                $htmlStr = "";
                $htmlStr .= "Hi " . $username . ",<br /><br />";
                $htmlStr .= "Please click the button below to verify your email and have access to the login page.<br /><br /><br />";
                $htmlStr .= "<a href='{$verificationLink}' target='_blank' style='padding:1em; font-weight:bold; background-color:blue; color:#fff;'>VERIFY EMAIL</a><br /><br /><br />";
                $htmlStr .= "Kind regards,<br />";
                $htmlStr .= "<a href='http://localhost:8080/' target='_blank'>The Code of Matcher</a><br />";

                $name = "The Code of Matcher";
                $email_sender = "no-reply@Matcher.com";
                $subject = "Verification Link ";
                $recipient_email = $email;
 
                $headers  = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                $headers .= "From: {$name} <{$email_sender}> \n";
 
                $body = $htmlStr;
                if(mail($recipient_email, $subject, $body, $headers))
                {
                
                    echo "<div = 'successMessage'>A verification email were sent to <b>" . $email . "</b>, please open your email inbox and click the given link so you can login.</div>";

                    $sql = "INSERT INTO users (username, usersEmail, usersFirstName, usersLastName, usersPassword, token) VALUES (?, ?, ?, ?, ?, ?)";
                    var_dump($sql);
                    $stmt = $conn->prepare($sql);
                    $hashpwd = password_hash($password, PASSWORD_DEFAULT);   
                    $stmt->bindParam(1, $username);
                    $stmt->bindParam(2, $email);
                    $stmt->bindParam(3, $first_name);
                    $stmt->bindParam(4, $last_name);  
                    $stmt->bindParam(5, $hashpwd);
                    $stmt->bindParam(6, $token);
                    if($stmt->execute())
                    {
                         echo "<div>Unverified email was saved to the database.</div>";
                    }
                    else
                    {
                        echo "<div>Unable to save your email to the database.";
                        //print_r($stmt->errorInfo());
                    }
                    header("location: ../index.php?signup=success");
                }
                else
                {
                    die("Sending failed.");
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
else
{
    header("location: ../index.php");
}
