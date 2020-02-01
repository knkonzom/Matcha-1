<?php
session_start();

if(!$_SESSION)
{
    header("location: index.php?error=needtologin");
} 
else 
{
    date_default_timezone_set('Africa/Johannesburg');
    $user_id = $_SESSION['userId'];
    
    function interest() 
    {
        $user_id = $_SESSION['userId'];
        
        include "config/database.php";
        try
        {
            $sql = "SELECT InterestDescription FROM interests WHERE interest_userId='{$user_id}' ";
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
</head>
<body>
<div class="header">
  <h1 class="logo">Matcha</h1>                                                                                                                                                                                                                                                      
  <div class="header-right">
  <?php
        
        include "config/database.php";
            try
            {
                $sql = "SELECT imgfullNameCam FROM profileimage WHERE update_userId = $user_id ORDER BY idCamImage DESC ";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $sql = "SELECT Location FROM profileupdate WHERE update_userId = $user_id ";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $location = $stmt->fetch(PDO::FETCH_ASSOC); 
                
                $sql = "SELECT AboutMe FROM profileupdate WHERE update_userId = $user_id ";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $aboutme = $stmt->fetch(PDO::FETCH_ASSOC);
        
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            } 
?>
<?php
   include "config/database.php";

 
   if(isset($_GET['click']))
   {
       
       $res = $_GET['click'];
       $sql = "UPDATE notification SET read_n=0 WHERE notify_id='$res' AND receiver_id=$user_id "; 
       $stmt = $conn->prepare($sql);
       $stmt->execute();
    //    header("location: viewprofile.php");
   }

   $sql = "SELECT * FROM notification WHERE receiver_id = $user_id ORDER BY notify_id DESC";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   $sql = "SELECT * FROM notification WHERE receiver_id = $user_id AND read_n='1' ";
   $newstmt = $conn->prepare($sql);
   $newstmt->execute();
   $notify =  $newstmt->rowCount();
?>
<a class="active">
    <div class="dropdown">Message <?PHP if($notify > 0){ echo "(".$notify. ")";} ?>
        <div class="dropdown-content">
          
            <?PHP 
                foreach($stmt as $value)
                {
                ?>
                <?PHP
                if($value['read_n'] == 1){
                ?>
                <p style="color:red;font-size:10px"><form action="" method="GET"><button type="submit" name="click" value="<?PHP echo $value['notify_id']; ?>" style="color:red"><?PHP echo $value['message']; ?></button></form></p>
              <?PHP
                }
                else
                {
                   ?>
                         <p style="color:black;font-size:10px"><?PHP echo $value['message']; ?></p>
                   <?PHP
                }
                if(strpos($value['message'], "like") !== false)
                {
                   ?>
                         <p style="color:red;font-size:10px"><form action="like.php" method="POST"><button type="submit" name="likeit" value="<?PHP echo $value['notify_id']; ?>" style="color:red"><?PHP echo $value['message']; ?></button></form></p>
                   <?PHP
                }
                ?>
                <?PHP
                }
            ?>
        
        </div>
    </div>
</a>
<?php
        if($row && $location && $aboutme)
        { 
            
            echo '<a class="active" href="browseProfile.php">Browse</a> ';
        }
  ?>
    <a class="active" href="PublicProfile.php">Profile</a>
    <a class="active" href="includes/logout.inc.php">Log Out</a>
    <a class="active" href="Profile_upload.php">Edit Profile Photo</a> 
  </div>
 
  <?php
        if($row && $location && $aboutme)
        { 
            echo '<img  width="120" height="120" src="upload/'.$row['imgfullNameCam'].' ">';
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
            echo "last seen"." ".$res['offline'];
        }
  ?>
  <div style="text-align: center; margin: 1%">
  <h2><?php $user = $_SESSION['userUid']; echo "<p><h1>Welcome $user</h1></p>";?><br/>
  <?php 
        if($row && $location && $aboutme) 
        {  
            ?>
                    <p><h5 style="color:green;">You are now connected, click browse above!</h5></p>
            <?PHP
        } 
        else
        {
            // echo "<p><h5>You need to upload profile photo and complete your information to connect with other users!</h5></p>" ;
            echo "<p><h5 style='color:green;'>upload profile photo and complete your profile to connect with other users!</h5></p>" ;
        }
    ?> 
</h2>
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

    <form action="savecam.php" method="POST" enctype="multipart/form-data">
       
            <input type="hidden" name="filename" >
            <input type="file" name="file" >
            <button type="submit"  name="submit">UPLOAD</button>
  </form> 
    <div class="scrollmenu">
        <?php 
               $sql = "SELECT * FROM webcamimage WHERE update_userId = $user_id ORDER BY idCamImage DESC limit 4";
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
        <option value="Other">Other</option>
        </select><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sexual Preferences:<br/> 
        <select type ="text" name="SexualPreference">
        <option value="">select Preference</option>
        <option value="Bisexual">Bisexual</option>
        <option value="Straight">Straight</option>
        <option value="Homosexual">Homosexual</option> 
        </select><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select Age:<br/>  
        <select type="text" name="age">
            <option value="">select age</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option><option value="60">60</option><option value="61">61</option><option value="62">62</option><option value="63">63</option><option value="64">64</option><option value="65">65</option><option value="66">66</option><option value="67">67</option><option value="68">68</option><option value="69">69</option><option value="70">70</option><option value="71">71</option><option value="72">72</option><option value="73">73</option><option value="74">74</option><option value="75">75</option><option value="76">76</option><option value="77">77</option><option value="78">78</option><option value="79">79</option><option value="80">80</option><option value="81">81</option><option value="82">82</option><option value="83">83</option><option value="84">84</option><option value="85">85</option><option value="86">86</option><option value="87">87</option><option value="88">88</option><option value="89">89</option><option value="90">90</option><option value="91">91</option><option value="92">92</option><option value="93">93</option><option value="94">94</option><option value="95">95</option><option value="96">96</option><option value="97">97</option><option value="98">98</option><option value="99">99</option><option value="100">100</option>
        </select><br/>
        <input type ="password" name="old-pwd" placeholder="Enter current Password"/><br/>
        <input type ="password" name="new-pwd" placeholder="Enter New Password"/><br/>
        <input type ="password" name="repeat-new-pwd" placeholder="Confirm New Password"/><br/>
        <input   style="background-color:dodgerblue; color:white; border-radius: 20px;" type ="submit" name="update" value="UPDATE PROFILE"><br/>
        <input type="checkbox" id="CheckAll">Check All&nbsp;&nbsp;<br/>
        <?php

            $sql = "SELECT Interest FROM profileupdate WHERE update_userId = $user_id ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchColumn();

            if (strpos($row, '#Bike') !== false)
                echo '<input type="checkbox"  class="checkBox" value="#Bike" checked>&nbsp;&nbsp;#Bike&nbsp;&nbsp';
            else 
                echo '<input type="checkbox"  class="checkBox" value="#Bike">&nbsp;&nbsp;#Bike&nbsp;&nbsp;';
            if (strpos($row, '#Car') !== false)
                echo '<input type="checkbox"  class="checkBox" value="#Car" checked>&nbsp;&nbsp;#Car&nbsp;&nbsp';
            else 
                echo '<input type="checkbox"  class="checkBox" value="#Car">&nbsp;&nbsp;#Car&nbsp;&nbsp;';
            
            if (strpos($row, '#Sport') !== false)
                echo '<input type="checkbox"  class="checkBox" value="#Sport" checked>&nbsp;&nbsp;#Sport&nbsp;&nbsp';
            else 
                echo '<input type="checkbox"  class="checkBox" value="#Sport">&nbsp;&nbsp;#Sport&nbsp;&nbsp;';
            if (strpos($row, '#Game') !== false)
                echo '<input type="checkbox"  class="checkBox" value="#Game" checked>&nbsp;&nbsp;#Game&nbsp;&nbsp';
            else 
                echo '<input type="checkbox"  class="checkBox" value="#Game">&nbsp;&nbsp;#Game&nbsp;&nbsp;';
            if (strpos($row, '#Read') !== false)
                echo '<input type="checkbox"  class="checkBox" value="#Read" checked>&nbsp;&nbsp;#Read&nbsp;&nbsp';
            else 
                echo '<input type="checkbox"  class="checkBox" value="#Read">&nbsp;&nbsp;#Read&nbsp;&nbsp;';
            if (strpos($row, '#Fight') !== false)
                echo '<input type="checkbox"  class="checkBox" value="#Fight" checked>&nbsp;&nbsp;#Fight&nbsp;&nbsp';
            else 
                echo '<input type="checkbox"  class="checkBox" value="#Fight">&nbsp;&nbsp;#Fight&nbsp;&nbsp;';
            if (strpos($row, '#Music') !== false)
                echo '<input type="checkbox"  class="checkBox" value="#Music" checked>&nbsp;&nbsp;#Music&nbsp;&nbsp';
            else 
                echo '<input type="checkbox"  class="checkBox" value="#Music">&nbsp;&nbsp;#Music&nbsp;&nbsp;';
            if (strpos($row, '#Boat') !== false)
                echo '<input type="checkbox"  class="checkBox" value="#Boat" checked>&nbsp;&nbsp;#Boat&nbsp;&nbsp';
            else 
                echo '<input type="checkbox"  class="checkBox" value="#Boat">&nbsp;&nbsp;#Boat&nbsp;&nbsp;';
                
        ?>
        <input   style="background-color:dodgerblue; color:white; border-radius: 20px;" type ="button" id="save_value" value="UPDATE INTEREST">
    </form>
</div>

</body>

<?php  
    include "footer.php";
}
?>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script> 
<script>  

$('#save_value').click(function (){

    var val = [];
    $(':checkbox:checked:not(#CheckAll)').each(function(i){
        val[i] =  $(this).val();
    }); 
    //  alert(val);
    $.ajax({
        type:"POST",
        url:"data.php",
        data:{
            value:val
        },
        success:function (data){
            console.log(data);
        }
    });

});

$(document).ready(function(){  
    $('#CheckAll').click(function (){
        $('.checkBox').prop('checked',$(this).prop('checked'));
    });
});
</script>

