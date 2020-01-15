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
    <a class="active" href="PublicProfile.php">Profile</a>
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
       <form action="search.php" method="POST">
  <input style="width:130px" type="text" name="search" placeholder="Search Profile" />
  <button style="height:40px;border-radius:4px; background-color:dodgerblue;" type="submit" name="SearchUser">search</button>
  </form>
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
                            $sql = "SELECT * FROM webcamimage WHERE update_userId = $user_id ORDER BY idCamImage DESC ";
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
    </div>    
    <h3>Personal Info</h3>
    <form action="update.php" method="Post">
        <textarea name="aboutme" placeholder="AboutMe:" value=""></textarea><br>
        <input type ="text" name="username" placeholder="Enter username"/><br/>
        <input type ="text" name="email" placeholder="Enter E-mail"/><br/>
        <input type ="text" name="lastName" placeholder="Last Name"/><br/>
        <input type ="text" name="firstName" placeholder="First Name"/><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gender:<br/>
        <select type ="text" name="gender">
        <option value="">select gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option> 
        </select><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sexual Preferences:<br/> 
        <select type ="text" name="SexualPreference">
        <option value="">select Preference</option>
        <option value="Straight">Straight</option>
        <option value="Bisexual">Bisexual</option>
        <option value="Homosexual">Homosexual</option> 
        </select><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;My interest:<br/>    
        <select type="text" name="interest">
        <option value="">select interest</option>
        <option value="#Volvo">#Volvo</option>
        <option value="#Saab">#Saab</option>
        <option value="#Opel">#Opel</option>
        <option value="#Audi">#Audi</option>
        </select><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select Age:<br/>  
        <select type="text" name="age">
            <option value="">select age</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option><option value="60">60</option><option value="61">61</option><option value="62">62</option><option value="63">63</option><option value="64">64</option><option value="65">65</option><option value="66">66</option><option value="67">67</option><option value="68">68</option><option value="69">69</option><option value="70">70</option><option value="71">71</option><option value="72">72</option><option value="73">73</option><option value="74">74</option><option value="75">75</option><option value="76">76</option><option value="77">77</option><option value="78">78</option><option value="79">79</option><option value="80">80</option><option value="81">81</option><option value="82">82</option><option value="83">83</option><option value="84">84</option><option value="85">85</option><option value="86">86</option><option value="87">87</option><option value="88">88</option><option value="89">89</option><option value="90">90</option><option value="91">91</option><option value="92">92</option><option value="93">93</option><option value="94">94</option><option value="95">95</option><option value="96">96</option><option value="97">97</option><option value="98">98</option><option value="99">99</option><option value="100">100</option>
        </select><br/>
        <input type ="password" name="old-pwd" placeholder="Enter current Password"/><br/>
        <input type ="password" name="new-pwd" placeholder="Enter New Password"/><br/>
        <input type ="password" name="repeat-new-pwd" placeholder="Confirm New Password"/><br/>
        <!-- <input type="hidden" name="love" value="mysave()"> -->
        <div style=" text-align:left;"> Current location: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php   try
            {
                    $sql = "SELECT Location FROM profileupdate WHERE update_userId = $user_id ";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
        
                    if($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        echo $row['Location'];
                    }                  
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();

            }?></div>
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
    
