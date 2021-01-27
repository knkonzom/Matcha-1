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
    <a class="active" href="index.php">Log Out</a> 
  </div>
</div>
<div style="text-align:center; margin:20%">

<b>Register Here</b>
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