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
    <a class="active" href="signup.php">SignUp</a>
  </div>
</div>

<div style="text-align: center; margin: 10%">
<b>Sign In</b>
<form action="includes/login.inc.php" method="POST">
<input type="text" name="login_user" value="<?php if(isset($_GET['login_user'])) echo $_GET['login_user'];?>" placeholder="username"><br>
<input type="password" name="login_pwd" placeholder="password"><br>
<input   style="background-color:dodgerblue; color:white; border-radius: 20px;" type ="submit" name="Submit-Login" value="LOGIN">
</form>
<a class="active" href="resetpassword.php">Resetpassword</a>
</div>
</body>
<?php
include "footer.php" 
?>
</html>