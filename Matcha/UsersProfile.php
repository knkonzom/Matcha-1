<?php
session_start();

if(!$_SESSION)
{
    header("location: index.php?error=needtologin");
} else 
{
    $user_id = $_SESSION['userId'];
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
    <a class="active" href="index.php">Home</a>
    <a class="active" href="includes/logout.inc.php">Log Out</a>
    <a class="active" href="Profile_upload.php">Edit Profile Photo</a> 
  </div>
  <?php
            include "config/database.php";
                try
                {
                    $sql = "SELECT imgfullNameCam FROM profileimage WHERE update_userId = $user_id ORDER BY idCamImage DESC ";
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
  <h2><?php $user = $_SESSION['userUid']; echo "<p><h1>Welcome $user</h1></p>";?></h2>
    </div>
</div>
<body>
    <?php
            if(isset($_GET['error']))
            {
                if($_GET['error'] == "emptyfields")
                {
                    echo '<strong><p style="background-color:black;text-align:center;font-size:15px;color:red">Fill in all fields!</p></strong>';
                }
                else if($_GET['error'] == "wrongpwd")
                {
                    echo '<strong><p style="background-color:black;text-align:center;font-size:15px;color:red">You have enter wrong password!</p></strong>';
                }
                else if($_GET['error'] == "nouser")
                {
                    echo '<strong><p style="background-color:black;text-align:center;font-size:15px;color:red">Username/E-mail does not exist!</p></strong>';
                }              
            }      
    ?>
    <?php
            try
            {
                    $sql = "SELECT AboutMe FROM profileupdate WHERE update_userId = $user_id ";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
        
                    if($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        $res = $row['AboutMe'];
                    }
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        ?>
    <div style="text-align:left; margin: 2%"> 
    <form style="text-align: right" action="" method="GET">
    <input style="background-color:red; color:white; border-radius: 20px; width:80px" type="submit" name="camera" value="Camera" >
    </form>
    <?php
    if(isset($_GET["camera"]))
    {
        echo '<div class="video-wrap">
        <video id="video" autoplay></video>
        <button id="snap">Capture</button>
        <canvas id="canvas" width="200" height="100"></canvas>
        </div> ';

        echo '<form action="savecam.php" method="Post">
        <input type="hidden" id="image" name="img">
        <button onclick="save()" id="submit" name="upload"><h2>Save</h2></button>
    </form>';
    }  
    ?>
    <div class="scrollmenu">
        <?php 
                            $sql = "SELECT * FROM webcamimage WHERE update_userId = $user_id ";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $row = $stmt->fetch();

                            $i = 0;
                            $len = count($row);

                            while($i < $len)
                            {
                                echo '<img  width="120" height="100" src="upload/'.$row['imgfullNameCam'].' ">';
                                
                            }  
        ?>
    </div>    
    <h3>Edit/Update Your Profile</h3>
    <form action="update.php" method="Post">
        <textarea name="aboutme" placeholder="AboutMe:" value=""></textarea><br>
        <input type ="text" name="username" placeholder="Enter username"/><br/>
        <input type ="text" name="email" placeholder="Enter E-mail"/><br/>
        <input type ="text" name="lastName" placeholder="Last Name"/><br/>
        <input type ="text" name="firstName" placeholder="First Name"/><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gender:<br/>
        <select type ="text" name="gender">
        <option value="Male">Male</option>
        <option value="Female">Female</option> 
        </select><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sexual Preferences:<br/> 
        <select type ="text" name="SexualPreference">
        <option value="straight">Straight</option>
        <option value="bisexual">Bisexual</option>
        <option value="homosexual">Homosexual</option> 
        </select><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Interest:<br/>    
        <select type="text" name="interest">
        <option value="volvo">#Volvo</option>
        <option value="saab">#Saab</option>
        <option value="opel">#Opel</option>
        <option value="audi">#Audi</option>
        </select><br/>   
        <input type ="password" name="old-pwd" placeholder="Enter current Password"/><br/>
        <input type ="password" name="new-pwd" placeholder="Enter New Password"/><br/>
        <input type ="password" name="repeat-new-pwd" placeholder="Confirm New Password"/><br/>
        <div style=" text-align:left;"> AboutMe: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php   try
            {
                    $sql = "SELECT AboutMe FROM profileupdate WHERE update_userId = $user_id ";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
        
                    if($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        echo $row['AboutMe'];
                    }
                    
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();

            }?></div>
        <input   style="background-color:dodgerblue; color:white; border-radius: 20px;" type ="submit" name="update" value="UPDATE PROFILE">
    </form>
</div>

</body>

<?php 
    include "footer.php";
}
?>

<script>
      
      'use strict';
      
      const video = document.getElementById('video');
      const canvas = document.getElementById('canvas');
      const snap = document.getElementById('snap');
      const erorrMsgElement = document.getElementById('span#ErrorMsg');

      const constraints = {
          audio: false,
          video:{
              width: 200, height: 100
          }
      };
      
      // Access webcam
      async function init(){
          try{
              const stream = await navigator.mediaDevices.getUserMedia(constraints);
              handleSuccess(stream);
          }
          catch(e){
              erorrMsgElement.innerHTML = `navigator.getUserMedia.error:{$(e.toString())}`;
          }
      }

      // success
      function handleSuccess(stream){
          window.stream = stream;
          video.srcObject = stream;
      }

      // load init
      init();
      // Draw image
      var context = canvas.getContext('2d');
      snap.addEventListener("click",function(){
          context.drawImage(video, 0, 0, 200, 100);
          console.log(photo.value);
      });

      const photo = document.getElementById('image');
      context.drawImage(img, x, y, 100, 200);
          
      function save() {
        photo.value = canvas.toDataURL();
      }

    </script>