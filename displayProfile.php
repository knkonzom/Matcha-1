<?php
include "config/database.php";
$conn = new PDO("mysql:host=$DB_DSN;dbname=Matcha", $DB_USER, $DB_PASSWORD);



date_default_timezone_set('Africa/Johannesburg');
session_start();
if(!$_SESSION)
{
    header("location: index.php?error=needtologin");
}else if($_SESSION['userId']){
if(isset($_POST['view']))
{
    
   $_SESSION['pro_id'] =  $_POST['pro_id']."<br>";
    $_POST['pro_username']."<br>";
    $user_aboutme = $_POST['pro_aboutme']."<br>";
    $user_age = $_POST['pro_age']."<br>";
    $user_gender = $_POST['pro_gender']."<br>";
    $user_sex = $_POST['pro_sex']."<br>";
    $user_location = $_POST['pro_location']."<br>";

    // function getCurrentUser() {
    //     $unique_id = $_SESSION['userId'];
    
    //     include "config/database.php";
    //     $conn = new PDO("mysql:host=$DB_DSN;dbname=Matcha", $DB_USER, $DB_PASSWORD);
        
    //         $sql = "SELECT username FROM profileupdate WHERE update_userId = '$unique_id' ";
    //         $stmt = $conn->prepare($sql);
    //         $stmt->execute();
    
    //         $res = $stmt->fetch(PDO::FETCH_ASSOC);
    //         echo strtoupper( $res['username']);
    // }

    function gender() 
    {
        echo $_POST['pro_gender'];
    }
    function sexpref() 
    {
        echo $_POST['pro_sex'];
    }
    function aboutme() 
    {
        echo $_POST['pro_aboutme'];
       
    }
    function Age() 
    { 
        echo $_POST['pro_age'];
    }
    function interest() 
    {
        $id_user = $_POST['pro_id'];
        include "config/database.php";
        $conn = new PDO("mysql:host=$DB_DSN;dbname=Matcha", $DB_USER, $DB_PASSWORD);

        try
        {
            $sql = "SELECT Interest FROM profileupdate WHERE update_userId='{$id_user}' ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $res = $stmt->fetchAll();
            foreach($res as $r)
            {
                echo $r['Interest'];
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
    <a class="active" href="UsersProfile.php">Home</a>
    <a class="active" href="displayProfile.php">Fame</a>
  </div>

  <?php
            include "config/database.php";
            $conn = new PDO("mysql:host=$DB_DSN;dbname=Matcha", $DB_USER, $DB_PASSWORD);

                try
                {
                    $sql = "SELECT imgfullNameCam FROM profileimage WHERE update_userId= '{$_POST['pro_id']}' ORDER BY idCamImage DESC";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($row)
                    { 
                       echo '<img  width="120" height="70px" src="upload/'.$row['imgfullNameCam'].' ">';
                    }
                }
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
                
                $sql = "SELECT * FROM status WHERE update_userId= '{$_POST['pro_id']}'";
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
  <div style="text-align: center; margin: 1%; margin-top:0%">
  <h2><?php $user = $_POST['pro_username']; echo "<p><h1 style='color:green;'> $user Profile</h1></p>";?></h2>
  <form action="like.php" method="POST">
    <button style="background-color:dodgerblue; border-radius:5px; height:30px" type="submit" name="likeit">like </button>
    <button style="background-color:dodgerblue; border-radius:5px; height:30px" type="submit" name="unlike">unlike</button>
    <button style="background-color:dodgerblue; border-radius:5px; height:30px" type="submit" name="block">block or report</button>
  </form>
 </div>
</div>
<body>
<div class="scrollmenu">
        <?php 
                            $sql = "SELECT * FROM webcamimage WHERE update_userId= '{$_POST['pro_id']}' ORDER BY idCamImage DESC limit 4 ";
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
<?PHP

include "config/database.php";
$conn = new PDO("mysql:host=$DB_DSN;dbname=Matcha", $DB_USER, $DB_PASSWORD);

$unique_id = $_SESSION['userId'];
    
include "config/database.php";
$conn = new PDO("mysql:host=$DB_DSN;dbname=Matcha", $DB_USER, $DB_PASSWORD);

    $sql = "SELECT username FROM profileupdate WHERE update_userId = '$unique_id' ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    
 $messege =  $res['username']." "."view your Profile";
 $sql = "INSERT INTO notification (receiver_id, `message`, read_n) VALUES ({$_POST['pro_id']}, '$messege', 1)";
 $stmt = $conn->prepare($sql);
 $stmt->execute();
?>
  
<?php
}
    include "footer.php";
    }
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