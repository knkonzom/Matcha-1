<?php
session_start();
if(!$_SESSION)
{
    header("location: index.php?error=needtologin");
}else if($_SESSION['userId']) {

?>
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
  <h1 class="logo">ResetPassword</h1>
  <div class="header-right">
    <a class="active" href="index.php">Home</a>
    <a class="active" href="index.php">LogOut</a>
  </div>
</div>
    <?php
        $selector = $_GET['selector'];
        $validator = $_GET['validator'];

        if(empty($selector) || empty($validator))
        {
            echo '<p style="font-size:25px">Could not validate your request!</p>';
        }
        else
        {
            if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false)
            {
                ?>
                <div style="text-align: center; margin: 10%">
                    <form action="includes/Reset-pwd.inc.php" method="post">
                        <input type="hidden" name="selector" value="<?php echo $selector?>">
                        <input type="hidden" name="validator" value="<?php echo $validator?>">
                        <p style="font-size:25px">Enter New Password</p>
                        <input type="password" name="pwd" placeholder=" Enter a new password..."><br>
                        <input type="password" name="pwd-repeat" placeholder=" Repeat new password..."><br>
                        <button type="submit" name="reset-password-submit">Reset Password</button>
                    </form>
                </div>
                <?php
            }
        }
    ?>
    
</body>
    
<?php
}
    include "footer.php";
  ?>
</html>
