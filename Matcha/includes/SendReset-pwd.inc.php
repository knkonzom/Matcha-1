<?php

if(isset($_POST['reset-submit']))
{

  include "../config/database.php";
  
  $selector = bin2hex(random_bytes(8));
  $token = random_bytes(32);
  $url = "http://localhost:8080/Matcha/Create-new-pwd.php?selector=".$selector. "&validator=" . bin2hex($token);
  $expire = date("U") + 1800;

  $userEmail = $_POST['email'];
  
  if(empty($userEmail))
  {
    header("location: ../resetpassword.php?error=emptyfield");
    exit();
  }
  else
  {
        try
        {
        
              $to = $userEmail;
              $subject = 'Reset your password for Matcha';
              $message = '<p> We received a password reset request. The link to reset your password is below, if you did not make this 
              request, you can ignore this email</p>';
              $message .= '<p>Here is your password reset link: </br>';
              $message .= '<a href="'. $url . '">' . $url . '</a></p>'; 
              $headers  = "MIME-Version: 1.0\r\n";
              $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
              $headers .= "From: Matcha <no-reply@Matcha.com>\r\n";
              $headers .= "Reply-To: $userEmail \n";

              
                  $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?";
                  $stmt = $conn->prepare($sql);
                  $stmt->bindParam(1, $userEmail);
                  $stmt->execute();
                  $sql = "INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpire) VALUES(?,?,?,?)";
                  $stmt = $conn->prepare($sql);
                  $hashtoken = password_hash($token, PASSWORD_DEFAULT);
                  $stmt->bindParam(1, $userEmail);
                  $stmt->bindParam(2, $selector);
                  $stmt->bindParam(3, $hashtoken);
                  $stmt->bindParam(4, $expire);
                  $stmt->execute();

                  if(mail($to, $subject, $message, $headers))
                  {
                      header("location: ../resetpassword.php?reset=success");
                      exit();
                  }     
        }
        catch (PDOException $e)
        {
             header("location: ../index.php?error=sqlerror");
             exit();
        }  
  }
}
else
{
  header("location: ../index.php");
}
