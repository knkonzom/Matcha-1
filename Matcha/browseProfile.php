<?php
session_start();
?>
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
    <a class="active" href="PublicProfile.php">Profile</a>
    <a class="active" href="UsersProfile.php">Home</a>
    <a class="active" href="includes/logout.inc.php">Log Out</a>
  </div>
  <div style="text-align: center; margin: 1%">
    </div>
</div>
<form action="search.php" method="POST">
  <input style="width:130px" type="text" name="search" placeholder="Search Profile" />
  <button style="height:40px;border-radius:4px; background-color:dodgerblue;" type="submit" name="SearchUser">search</button>
  </form>
<body>
</body>
<?php 
    include "footer.php";
?>