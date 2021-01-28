<!DOCTYPE html>
<?php
include "./config/setup.php";
session_start();

?>
<html>
<head>
    <title>Matcha</title>  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    
</head>
<body>
<div class="header">
  <h1 class="logo">Matcha</h1>
  <div class="header-right">
    <a class="active" href="signup.php">SignUp</a>
  </div>
  <!-- <form action="search.php" method="POST">
  <input type="text" name="search" placeholder="Search Profile" />
  <button type="submit" name="SearchUser">search</button>
  </form> -->
</div>

<div style="text-align: center; margin: 10%">
<b>Sign In</b>
<?php
            if(isset($_GET['error']))
            {
                if($_GET['error'] == "emptyfields")
                {
                    echo '<strong><p style="background-color:white;text-align:center;font-size:15px;color:red">Fill in all fields!</p></strong>';
                }
                else if($_GET['error'] == "wrongpwd")
                {
                    echo '<strong><p style="background-color:white;text-align:center;font-size:15px;color:red">You have entered a wrong password!</p></strong>';
                }
                else if($_GET['error'] == "nouser")
                {
                    echo '<strong><p style="background-color:white;text-align:center;font-size:15px;color:red">Username/E-mail does not exist!</p></strong>';
                }
                else if($_GET['error'] == "notverified")
                {
                    echo '<strong><p style="background-color:white;text-align:center;font-size:15px;color:red">You need to verify your account.</p></strong>';
                }                         
            }
            else if(isset($_GET['activate']) == "success")
            {
                echo '<strong><p style="background-color:white;text-align:center;font-size:15px;color:green">Your email is activated, thanks!. You may now login.</p></strong>';
            }
            
            else if(isset($_GET['updatesuccess']) == "updated")
            {
                echo '<strong><p style="background-color:white;text-align:center;font-size:15px;color:green">You can now login with your new password.</p></strong>';
            }
            ?>
<form action="includes/login.inc.php" method="POST">
<input type="text" name="login_user" value="<?php if(isset($_GET['login_user'])) echo $_GET['login_user'];?>" placeholder="username"><br>
<input type="password" name="login_pwd" placeholder="password"><br>
<input   style="background-color:dodgerblue; color:white; border-radius: 20px;" type ="submit" name="Submit-Login" value="LOGIN">
</form>
<a class="active" href="resetpassword.php"><button style="background-color:red; color:white; border-radius: 20px;">Reset Password</button></a>
</div>
</body>
<?php
include "footer.php" 
?>
</html>