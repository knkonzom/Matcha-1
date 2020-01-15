<?php
session_start();

$user_id = $_SESSION['publicprofile'];
$id_user = $_SESSION['update_id'];
$aboutme = $_SESSION['about'];
$gender = $_SESSION['gender'];
$sexpref = $_SESSION['sexpref'];

function gender() 
{
    //   session_start();
    $user_id = $_SESSION['publicprofile'];
    include "config/database.php";

    try
    {
        $sql = "SELECT Gender FROM profileupdate WHERE username = '$user_id' ORDER BY Updateid DESC ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        if($res = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo $res['Gender'];
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}
    function sexpref() {
        //   session_start();
        $user_id = $_SESSION['publicprofile'];
        include "config/database.php";
        try
        {
            $sql = "SELECT sexualPreference FROM profileupdate WHERE username = '$user_id' ORDER BY Updateid DESC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
    
            if($res = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                echo $res['sexualPreference'];
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    function aboutme() {
        //  session_start();
        $user_id = $_SESSION['publicprofile'];
        include "config/database.php";
        try
        {
            $sql = "SELECT AboutMe FROM profileupdate WHERE username = '$user_id' ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            if($res = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                echo $res['AboutMe'];
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    function Age() {
        //  session_start();
        $user_id = $_SESSION['publicprofile'];
        include "config/database.php";
    
        try
        {
            $sql = "SELECT Age FROM profileupdate WHERE username = '$user_id' ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
    
            if($res = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                echo $res['Age'];
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    function interest() {
        //  session_start();
        $id_user = $_SESSION['update_id'];
        include "config/database.php";
        try
        {
            $sql = "SELECT InterestDescription FROM interests WHERE interest_userId='{$id_user}' ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_COLUMN);
            $arr = array_unique($res);

            $i = 0;
            $len = count($arr);
            while($i < $len)
            {
                
                echo '<a class"active" >'.$arr[$i].'</a>';
                echo "&nbsp&nbsp";
                $i++;
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Matcha</title>  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>
<div class="header">
  <h1 class="logo">Matcha</h1>
  <div class="header-right">
    <a class="active" href="index.php">Home</a>
    <a class="active" href="index.php">Follow</a>
  </div>
  <?php
            include "config/database.php";
                try
                {
                    $sql = "SELECT imgfullNameCam FROM profileimage WHERE update_userId= '$id_user' ORDER BY idCamImage DESC ";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($row)
                    { 
                       echo '<img  width="120" height="120" src="upload/'.$row['imgfullNameCam'].' ">';
                    }
                }
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
    ?>
  <div style="text-align: center; margin: 1%">
  <h2><?php $user = $_SESSION['publicprofile']; echo "<p><h1> $user Profile</h1></p>";?></h2>
  <form action="like.php" method="POST">
    <button style="background-color:dodgerblue; border-radius:5px; height:30px" type="submit" name="likeit">like profile</button>
  </form>
 </div>
</div>
<body>
<div class="scrollmenu">
        <?php 
                            $sql = "SELECT * FROM webcamimage WHERE username = '$user_id' ORDER BY idCamImage DESC ";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $row = $stmt->fetchAll();

                            $i = 0;
                            $len = count($row);

                            while($i < $len)
                            {
                                echo ' <img  width="120" height="100" src="upload/'.$row[$i]['imgfullNameCam'].' ">';
                                $i++;
                            }  
        ?>
    </div><br/>
    <table>
        <tr>
            <td style="font-size:24px"><b>About you:</b></td>
            <td style="font-size:12px"><?php aboutme(); ?></td>
        </tr>
    </table>
    <hr>
    <table>
        <tr>
            <td style="font-size:22px"><b>Age:</b> </td> 
            <td style="font-size:12px"><?php Age(); ?></td>
        </tr>
    </table>
    <hr>
    <table>
        <tr>
            <td style="font-size:22px"><b>Gender:</b> </td> 
            <td style="font-size:12px"><?php gender(); ?></td>
        </tr>
    </table>
    <hr>
    <table>
        <tr>
            <td style="font-size:22px"><b>Sexuality: </b>   </td> 
            <td style="font-size:12px"><?php sexpref(); ?></td>
        </tr>
    </table>
    <hr>
    <table>
        <tr>
            <td style="font-size:22px"><b>My interest: </b>   </td> 
            <td style="font-size:12px"><?php interest(); ?></td>
        </tr>
    </table>
    <hr>
    <table>
        <tr>
            <td style="font-size:22px"><b>Current location: </b>   </td> 
            <td style="font-size:12px"><span id="city"></span></td>
        </tr>
    </table> 
</body>
<?php 
    include "footer.php";
?>

<script>
      $.getJSON('https://geolocation-db.com/json/')
         .done (function(location) {
            // $('#country').html(location.country_name);
            // $('#state').html(location.state);
            $('#city').html(location.city);
            // $('#latitude').html(location.latitude);
            // $('#longitude').html(location.longitude);
            // $('#ip').html(location.IPv4);
         });
</script>
