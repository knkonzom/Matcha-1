<!DOCTYPE html>
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
    <a class="active" href="index.php">Home</a>
    <a class="current" href="signup.php">SignUp</a> 
  </div>
</div>
<div style="text-align:center; margin:20%; margin-top:10px;">

<b>Register Here</b>
<?php
                    if(isset($_GET['error']))
                    {
                        if($_GET['error'] == "emptyfields")
                        {
                            echo '<strong><p style="font-size:20px;color:red">Fill in all fields!</p></strong>';
                        }
                        else if($_GET['error'] == "invaliduidmail")
                        { 
                            echo '<strong><p style="font-size:20px;color:red">Invalid username/e-mail!</p></strong>';
                        }
                        else if($_GET['error'] == "invalidmail")
                        { 
                            echo '<strong><p style="font-size:20px;color:red">Invalid Email!</p></strong>';
                            '<p> </p>';
                        }
                        else if($_GET['error'] == "passwordlen")
                        { 
                            echo '<strong><p style="font-size:20px;color:red">Your password must be up to 8 or more!</p></strong>';
                        }
                        else if($_GET['error'] == "passwordCAP" || $_GET['error'] == "passwordNUM")
                        { 
                            echo '<strong><p style="font-size:20px;color:red">Your password must be Capital letter and numbers!</p></strong>';
                        }
                        else if($_GET['error'] == "invalidmail")
                        { 
                            echo '<strong><p style=style="font-size:20px;color:red">Invalid e-mail!</p></strong>';
                            
                        }
                        else if($_GET['error'] == "passwordcheck")
                        { 
                            echo '<strong><p style=style="font-size:20px;color:red">Your password do not match!</p></strong>';
                        }
                        else if($_GET['error'] == "usertaken")
                        { 
                            echo '<strong><p style="font-size:20px;color:red">Username already exist!</p></strong>';
                        }
                        else if($_GET['error'] == "emailtaken")
                        { 
                            echo '<strong><p style=style="font-size:20px;color:red">E-mail already exist!</p></strong>';
                        }
                    }
                    else if(isset($_GET['signup']) == "success")
                    {
                        echo '<strong><p style="font-size:20px;color:green">Signup successful!</p></strong>';
                        echo '<strong><p style="background-color:black;text-align:center;font-size:20px;color:green">To complete your registration, login to your email address and click the verification link.</p></strong>';
                    } 
                ?>
<form action="includes/signup.inc.php" method="POST">
      <input type="text" name="username" value="<?php if(isset($_GET['username'])) echo $_GET['username'];?>" placeholder="username"><br>
      <input type="text" name="email" value="<?php if(isset($_GET['email'])) echo $_GET['email'];?>" placeholder="email-address"><br>
      <input type="text" name="FirstName" value="<?php if(isset($_GET['FirstName'])) echo $_GET['FirstName'];?>"placeholder="first name"><br>
      <input type="text" name="LastName" value="<?php if(isset($_GET['LastName'])) echo $_GET['LastName'];?>" placeholder="last name"><br>
      <input type="password" name="Password" placeholder="password"><br>
      <input type="password" name="Repeat-password" placeholder="Repeat-password"><br>
      <button style="background-color:dodgerblue; color:white; border-radius: 20px;" type="submit" name="Submit-SignUp">Sign Up</button>
</form>
</div>
</body>
<?php
include "footer.php" 
?>
</html>