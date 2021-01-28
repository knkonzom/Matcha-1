<?php

session_start();


$user_id = $_SESSION['userUid'];

function getCurrentUser() {
    $unique_id = $_SESSION['userId'];

    include "config/database.php";
    $conn = new PDO("mysql:host=$DB_DSN;dbname=matcha2", $DB_USER, $DB_PASSWORD);
    
        $sql = "SELECT username FROM profileupdate WHERE update_userId = '$unique_id' ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        echo strtoupper( $res['username']);
}

function gender() 
{
    $user_id = $_SESSION['userUid'];
    $unique_id = $_SESSION['userId'];

    include "config/database.php";
    $conn = new PDO("mysql:host=$DB_DSN;dbname=matcha2", $DB_USER, $DB_PASSWORD);


    try
    {
        $sql = "SELECT Gender FROM profileupdate WHERE update_userId = '$unique_id' ORDER BY Updateid DESC ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        if($res = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo strtoupper( $res['Gender']);
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}
    function sexpref() 
    {
        $user_id = $_SESSION['userUid'];
        $unique_id = $_SESSION['userId'];

        include "config/database.php";
        $conn = new PDO("mysql:host=$DB_DSN;dbname=matcha2", $DB_USER, $DB_PASSWORD);

        try
        {
            $sql = "SELECT sexualPreference FROM profileupdate WHERE update_userId = '$unique_id' ORDER BY Updateid DESC";
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
    function aboutme() 
    {
        $user_id = $_SESSION['userUid'];
        $unique_id = $_SESSION['userId'];
        include "config/database.php";
        $conn = new PDO("mysql:host=$DB_DSN;dbname=matcha2", $DB_USER, $DB_PASSWORD);

        try
        {
            $sql = "SELECT AboutMe FROM profileupdate WHERE update_userId = '$unique_id' ";
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
    function Age() 
    {
        $user_id = $_SESSION['userUid'];
        $unique_id = $_SESSION['userId'];

        include "config/database.php";
        $conn = new PDO("mysql:host=$DB_DSN;dbname=matcha2", $DB_USER, $DB_PASSWORD);
    
        try
        {
            $sql = "SELECT Age FROM profileupdate WHERE update_userId = '$unique_id' ";
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
    function interest() 
    {
        $id_user = $_SESSION['userId'];
        include "config/database.php";
        $conn = new PDO("mysql:host=$DB_DSN;dbname=matcha2", $DB_USER, $DB_PASSWORD);
        
            try
            {
                $sql = "SELECT Interest FROM profileupdate WHERE update_userId='{$id_user}' ";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $res = $stmt->fetchAll();
                
                foreach($res as $r)
                {
                    echo strtoupper($r['Interest']);
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
<div class="header" style="margin-top:0px">
  <h1 class="logo">Matcha</h1>
  <div class="header-right">
    <a class="current" href="PublicProfile.php">Profile</a>
    <a class="active" href="UsersProfile.php">Edit Profile</a>
<?php
   include "config/database.php";
    $conn = new PDO("mysql:host=$DB_DSN;dbname=matcha2", $DB_USER, $DB_PASSWORD);

   $sql = "SELECT * FROM notification WHERE receiver_id = '{$_SESSION['userId']}' ";
   $stmt = $conn->prepare($sql);
   $stmt->execute();
   $notify =  $stmt->rowCount();
?>
<a class="active" href="PublicProfile.php">Fame: <?PHP echo $notify ?></a>
  </div>

  <?php
            include "config/database.php";
            $conn = new PDO("mysql:host=$DB_DSN;dbname=matcha2", $DB_USER, $DB_PASSWORD);

                try
                {
                    $sql = "SELECT imgfullNameCam FROM profileimage WHERE update_userId= '{$_SESSION['userId']}' ORDER BY idCamImage DESC ";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($row)
                    { 
                       echo '<img  width="100" height="70" src="upload/'.$row['imgfullNameCam'].' ">';
                    }else {
                        echo '<img alt="Qries" src="https://www.edmundsgovtech.com/wp-content/uploads/2020/01/default-picture_0_0.png" width=100" height="70">';
                    }

                   $sql = "UPDATE profileupdate SET imgfullNameCam ='{$row['imgfullNameCam']}' WHERE update_userId= '{$_SESSION['userId']}' ";
                   $stmt = $conn->prepare($sql);
                   $stmt->execute();

                }
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }

                $sql = "SELECT * FROM status WHERE update_userId= '{$_SESSION['userId']}'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $res = $stmt->fetch(PDO::FETCH_ASSOC);

                if($res['online'] == 1)
                {
                    echo '<p style=" color:green">online</p>';
                }
                else if($res['online'] == 0)
                {
                    echo "last seen: <b>".$res['offline']; echo "</b>";
                }
    ?>
    
    <div style="text-align: center; margin-top: 0%">
        <?php 
        $user = $_SESSION['userUid']; 
        echo "<p><h1 style='color:green'>Your Profile"; ?></h1></p>
        <!-- <form action="like.php" method="POST">
            <button style="background-color:dodgerblue; border-radius:5px; height:30px" type="submit" name="likeit">like profile</button>
        </form> -->
    </div>
</div>
<body>
<div class="scrollmenu" style="height:100px;margin-top:0px">
        <?php 
                            $sql = "SELECT * FROM webcamimage WHERE update_userId= '{$_SESSION['userId']}' ORDER BY idCamImage DESC LIMIT 4";
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
            <td style="font-size:22px"><b>Current location: </b>  </td>
            
            <td> <form action="" method="GET"> 
                <button style="background-color:dodgerblue; border-radius:5px; height:30px; width:50px " type="submit" name="allow" value="Allow">Allow</button>
             </form></td>
                
            <?php
            if(isset($_GET['allow']))
            {
                if($_SESSION['userUid']) {
                    echo '<td style="font-size:22px"><span id="city"></span></td>';
                }
               // echo '<td style="font-size:22px"><span id="city"></span></td>';
            
            }
            ?>
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