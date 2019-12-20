
<!DOCTYPE html>
<html>
<head>
    <title>ResetPassword</title>  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
  <h1 class="logo">Matcha</h1>
  <div class="header-right">
    <a class="active" href="index.php">Home</a>
    <a class="active" href="index.php">LogOut</a>
  </div>
</div>
    <div style="text-align: center; margin: 10%">
    <form method="post" action="includes/SendReset-pwd.inc.php">
    <div class="text" >
    <p style="font-size:25px">Enter Email Address To Send Password Link</p>
    <?php
            if(isset($_GET["newpwd"]))
            {
                if($_GET["newpwd"] == "passwordupdated")
                {
                    echo '<strong><p style="color:#73AD21; text-align:center">Your password has been reset!</p></strong>';
                }
            }
            else if(isset($_GET["reset"]))
            {
                if($_GET["reset"] == "success")
                {
                    echo '<strong><p style="color:#73AD21; text-align:center"><strong>A link has been sent to the require email!</p></strong>';
                }
            }
            else if(isset($_GET["error"]))
            {
                if($_GET["error"] == "emptyfield")
                {
                    echo '<strong><p style="color:red; text-align:center"><strong>You have send and empty fields!</p></strong>';
                }
            }
    ?>
    <input type="text" name="email" placeholder="Enter your e-mail address..."><br>
    <button type="submit" name="reset-submit">Send Link</button>
    </div>
  </form>
</div>
</body>
<?php
    include "footer.php";
  ?>
</html>

