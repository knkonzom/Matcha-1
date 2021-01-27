<?php
session_start();
if(!$_SESSION)
{
    header("location: index.php?error=needtologin");
}else {
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
    <a class="current" href="Profile_upload.php">Edit profile</a>
    <a class="active" href="PublicProfile.php">Home</a>
    <a class="active" href="includes/logout.inc.php">Log Out</a>
  </div>
<form action="includes/image_upload.inc.php" method="POST" enctype="multipart/form-data">
        <h1 class="logo">
            <input type="hidden" name="filename" >
            <input type="file" name="file" >
            <button type="submit"  name="submit">UPLOAD</button>
        </h1>
  </form>
  </html>
<?php
}
?>

