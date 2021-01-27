<?php
session_start();
if(!$_SESSION['userId'])
{
    header("location: index.php?error=needtologin");
}else if($_SESSION['userId']) {
include "config/database.php";
$conn = new PDO("mysql:host=$DB_DSN;dbname=matcha2", $DB_USER, $DB_PASSWORD);


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
  <a class="active" href="UsersProfile.php">Edit Profile</a> 
    <a class="active" href="PublicProfile.php">Profile</a>
    <!-- <a class="active" href="UsersProfile.php">Home</a> -->
    <a class="active" href="includes/logout.inc.php">Log Out</a>
  </div>
  <div style="text-align: center; margin: 1%">
    </div>
</div>
<form action="search.php" method="POST">
  <input style="width:130px" type="text" name="search" placeholder="Search Profile" />
  <button style="height:40px;border-radius:4px; background-color:dodgerblue;" type="submit" name="SearchUser">search</button>
  </form>
  <form class="main_one" action="advanced_search.php" method="POST">
    <button style="height:40px;border-radius:4px; background-color:dodgerblue;" type="submit" name="SearchAdvanced">Advanced Search</button>
  </form>

  <h1>Recommendation</h1>

  <?php
   $user_id =  $_SESSION['userId'];

   $sql = "SELECT * FROM profileupdate WHERE update_userId='$user_id' ";
   $stmt = $conn->prepare($sql);
   $stmt->execute();
   $row = $stmt->fetch(PDO::FETCH_ASSOC);
   $_SESSION['sex_orient'] =  $row['sexualPreference']; 
   $_SESSION['sex_gender'] =  $row['Gender']; 
   $_SESSION['location'] =  $row['Location']; 
   $_SESSION['inter'] =  $row['Interest']; 


   if($_SESSION['sex_gender'] == "Male" && $_SESSION['sex_orient'] == "Straight")
   {
        
                try
                { 
 
                      $sql = "SELECT * FROM profileupdate WHERE sexualPreference='Straight' AND Gender='Female' AND Location='{$_SESSION['location']}' AND fame > 0 ";
                      $stmt = $conn->prepare($sql);
                      $stmt->execute();
                      $row1 = $stmt->fetchAll(PDO::FETCH_ASSOC);


                     
                      foreach($row1 as $person)
                      {
                        
                        if ($person['update_userId'] != $user_id)
                        {  
                          $array1 = array($_SESSION['inter']);
                          $array2 = array($person['Interest']);

                          $array1 = explode(" ", $array1[0]);
                          $array2 = explode(" ", $array2[0]);
                        
                                      if (count(array_intersect($array1, $array2)) != 0)
                                      {

                                                  $_SESSION['listall_userid'] = $person['update_userId'];
                                                  $_SESSION['listall_userUid'] = $person['username'];
                                              ?>
                                              <div>
                                                <div class="recog"><?php 
                                                echo '<img src="upload/' .$person['imgfullNameCam'].'" width="50px /">'."<br>";
                                                echo $person["username"]."<br>";
                                                echo $person["Gender"].",".$person["Age"] ."<br>";
                                                echo $person["Location"];  
                                                ?>
                                                <form action="displayProfile.php" method="POST">
                                                  <input type="hidden" name="pro_image" value="<?php echo $person['imgfullNameCam'];?>">
                                                  <input type="hidden" name="pro_id" value="<?php echo $person['update_userId'];?>">
                                                  <input type="hidden" name="pro_username" value="<?php echo $person['username'];?>">
                                                  <input type="hidden" name="pro_aboutme" value="<?php echo $person['AboutMe'];?>">
                                                  <input type="hidden" name="pro_age" value="<?php echo $person['Age'];?>">
                                                  <input type="hidden" name="pro_gender" value="<?php echo $person['Gender'];?>">
                                                  <input type="hidden" name="pro_sex" value="<?php echo $person['sexualPreference'];?>">
                                                  <input type="hidden" name="pro_interest" value=" <?php echo $person['Interest'];?>">
                                                  <input type="hidden" name="pro_location" value="<?php echo $person['Location'];?>">
                                                  <button type="submit" name="view" style="background-color:green;">view</button>
                                                </form> 
                                                <?PHP
                                                ?></div>
                                              </div>
                                              <?php
                                      }
                                     
                        }
        }
                }
                catch(PDOException $e)
                {
                  $e->getMessage();
                }
   } 
   else if($_SESSION['sex_gender'] ==  "Female" && $_SESSION['sex_orient'] == "Straight" )
   {
                      
                      
                try
                { 

                      $sql = "SELECT * FROM profileupdate WHERE sexualPreference='Straight' AND Gender='Male' AND Location='{$_SESSION['location']}' AND fame > 0 ";
                      $stmt = $conn->prepare($sql);
                      $stmt->execute();
                      $row1 = $stmt->fetchAll(PDO::FETCH_ASSOC);             

                      foreach($row1 as $person)
                      {
                        
                        if ($person['update_userId'] != $user_id)
                        {  
                          $array1 = array($_SESSION['inter']);
                          $array2 = array($person['Interest']);
                          
                          $array1 = explode(" ", $array1[0]);
                          $array2 = explode(" ", $array2[0]);
                        
                                      if (count(array_intersect($array1, $array2)) != 0)
                                      {

                                                  $_SESSION['listall_userid'] = $person['update_userId'];
                                                  $_SESSION['listall_userUid'] = $person['username'];
                                              ?>
                                              <div>
                                                <div class="recog"><?php 
                                                echo '<img src="upload/' .$person['imgfullNameCam'].'" width="50px /">'."<br>";
                                                echo $person["username"]."<br>";
                                                echo $person["Gender"].",".$person["Age"] ."<br>";
                                                echo $person["Location"];  
                                                ?>
                                                <form action="displayProfile.php" method="POST">
                                                  <input type="hidden" name="pro_image" value="<?php echo $person['imgfullNameCam'];?>">
                                                  <input type="hidden" name="pro_id" value="<?php echo $person['update_userId'];?>">
                                                  <input type="hidden" name="pro_username" value="<?php echo $person['username'];?>">
                                                  <input type="hidden" name="pro_aboutme" value="<?php echo $person['AboutMe'];?>">
                                                  <input type="hidden" name="pro_age" value="<?php echo $person['Age'];?>">
                                                  <input type="hidden" name="pro_gender" value="<?php echo $person['Gender'];?>">
                                                  <input type="hidden" name="pro_sex" value="<?php echo $person['sexualPreference'];?>">
                                                  <input type="hidden" name="pro_interest" value=" <?php echo $person['Interest'];?>">
                                                  <input type="hidden" name="pro_location" value="<?php echo $person['Location'];?>">
                                                  <button type="submit" name="view" style="background-color:green;">view</button>
                                                </form> 
                                                <?PHP
                                                ?></div>
                                              </div>
                                              <?php
                                      }
                                     
                        }
        }
                }
                catch(PDOException $e)
                {
                  $e->getMessage();
                }
   }        
   else if($_SESSION['sex_gender'] ==  "Female" && $_SESSION['sex_orient'] == "Homosexual"  )
   {
              try
              { 

                    $sql = "SELECT * FROM profileupdate WHERE sexualPreference='Homosexual' AND Gender='Female' AND Location='{$_SESSION['location']}' AND fame > 0";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $row1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($row1 as $person)
                    {
                      
                      if ($person['update_userId'] != $user_id)
                      {  
                        $array1 = array($_SESSION['inter']);
                        $array2 = array($person['Interest']);
                        
                        $array1 = explode(" ", $array1[0]);
                        $array2 = explode(" ", $array2[0]);
                      
                                    if (count(array_intersect($array1, $array2)) != 0)
                                    {

                                                $_SESSION['listall_userid'] = $person['update_userId'];
                                                $_SESSION['listall_userUid'] = $person['username'];
                                            ?>
                                            <div>
                                              <div class="recog"><?php 
                                              echo '<img src="upload/' .$person['imgfullNameCam'].'" width="50px /">'."<br>";
                                              echo $person["username"]."<br>";
                                              echo $person["Gender"].",".$person["Age"] ."<br>";
                                              echo $person["Location"];  
                                              ?>
                                              <form action="displayProfile.php" method="POST">
                                                <input type="hidden" name="pro_image" value="<?php echo $person['imgfullNameCam'];?>">
                                                <input type="hidden" name="pro_id" value="<?php echo $person['update_userId'];?>">
                                                <input type="hidden" name="pro_username" value="<?php echo $person['username'];?>">
                                                <input type="hidden" name="pro_aboutme" value="<?php echo $person['AboutMe'];?>">
                                                <input type="hidden" name="pro_age" value="<?php echo $person['Age'];?>">
                                                <input type="hidden" name="pro_gender" value="<?php echo $person['Gender'];?>">
                                                <input type="hidden" name="pro_sex" value="<?php echo $person['sexualPreference'];?>">
                                                <input type="hidden" name="pro_interest" value=" <?php echo $person['Interest'];?>">
                                                <input type="hidden" name="pro_location" value="<?php echo $person['Location'];?>">
                                                <button type="submit" name="view" style="background-color:green;">view</button>
                                              </form> 
                                              <?PHP
                                              ?></div>
                                            </div>
                                            <?php
                                    }
                                   
                      }
      }
              }
              catch(PDOException $e)
              {
                $e->getMessage();
              }
   }
   else if($_SESSION['sex_gender'] == "Male" && $_SESSION['sex_orient'] == "Homosexual"  )
   {
              try
              { 

                    $sql = "SELECT * FROM profileupdate WHERE sexualPreference='Homosexual' AND Gender='Male' AND Location='{$_SESSION['location']}' AND fame > 0 ";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $row1 = $stmt->fetchAll(PDO::FETCH_ASSOC);        

                    foreach($row1 as $person)
                      {
                        
                        if ($person['update_userId'] != $user_id)
                        {  
                          $array1 = array($_SESSION['inter']);
                          $array2 = array($person['Interest']);
                          
                          $array1 = explode(" ", $array1[0]);
                          $array2 = explode(" ", $array2[0]);
                        
                                      if (count(array_intersect($array1, $array2)) != 0)
                                      {

                                                  $_SESSION['listall_userid'] = $person['update_userId'];
                                                  $_SESSION['listall_userUid'] = $person['username'];
                                              ?>
                                              <div>
                                                <div class="recog"><?php 
                                                echo '<img src="upload/' .$person['imgfullNameCam'].'" width="50px /">'."<br>";
                                                echo $person["username"]."<br>";
                                                echo $person["Gender"].",".$person["Age"] ."<br>";
                                                echo $person["Location"];  
                                                ?>
                                                <form action="displayProfile.php" method="POST">
                                                  <input type="hidden" name="pro_image" value="<?php echo $person['imgfullNameCam'];?>">
                                                  <input type="hidden" name="pro_id" value="<?php echo $person['update_userId'];?>">
                                                  <input type="hidden" name="pro_username" value="<?php echo $person['username'];?>">
                                                  <input type="hidden" name="pro_aboutme" value="<?php echo $person['AboutMe'];?>">
                                                  <input type="hidden" name="pro_age" value="<?php echo $person['Age'];?>">
                                                  <input type="hidden" name="pro_gender" value="<?php echo $person['Gender'];?>">
                                                  <input type="hidden" name="pro_sex" value="<?php echo $person['sexualPreference'];?>">
                                                  <input type="hidden" name="pro_interest" value=" <?php echo $person['Interest'];?>">
                                                  <input type="hidden" name="pro_location" value="<?php echo $person['Location'];?>">
                                                  <button type="submit" name="view" style="background-color:green;">view</button>
                                                </form> 
                                                <?PHP
                                                ?></div>
                                              </div>
                                              <?php
                                      }
                                     
                        }
        }
              }
              catch(PDOException $e)
              {
                $e->getMessage();
              }
   }
   else
   {
                    try
                    { 

                          $sql = "SELECT * FROM profileupdate WHERE Location='{$_SESSION['location']}' AND fame > 0 ";
                          $stmt = $conn->prepare($sql);
                          $stmt->execute();
                          $row1 = $stmt->fetchAll(PDO::FETCH_ASSOC);                       

                          foreach($row1 as $person)
                      {
                        
                        if ($person['update_userId'] != $user_id)
                        {  
                          $array1 = array($_SESSION['inter']);
                          $array2 = array($person['Interest']);
                          
                          $array1 = explode(" ", $array1[0]);
                          $array2 = explode(" ", $array2[0]);
                        
                                      if (count(array_intersect($array1, $array2)) != 0)
                                      {

                                                  $_SESSION['listall_userid'] = $person['update_userId'];
                                                  $_SESSION['listall_userUid'] = $person['username'];
                                              ?>
                                              <div>
                                                <div class="recog"><?php 
                                                echo '<img src="upload/' .$person['imgfullNameCam'].'" width="50px /">'."<br>";
                                                echo $person["username"]."<br>";
                                                echo $person["Gender"].",".$person["Age"] ."<br>";
                                                echo $person["Location"];  
                                                ?>
                                                <form action="displayProfile.php" method="POST">
                                                  <input type="hidden" name="pro_image" value="<?php echo $person['imgfullNameCam'];?>">
                                                  <input type="hidden" name="pro_id" value="<?php echo $person['update_userId'];?>">
                                                  <input type="hidden" name="pro_username" value="<?php echo $person['username'];?>">
                                                  <input type="hidden" name="pro_aboutme" value="<?php echo $person['AboutMe'];?>">
                                                  <input type="hidden" name="pro_age" value="<?php echo $person['Age'];?>">
                                                  <input type="hidden" name="pro_gender" value="<?php echo $person['Gender'];?>">
                                                  <input type="hidden" name="pro_sex" value="<?php echo $person['sexualPreference'];?>">
                                                  <input type="hidden" name="pro_interest" value=" <?php echo $person['Interest'];?>">
                                                  <input type="hidden" name="pro_location" value="<?php echo $person['Location'];?>">
                                                  <button type="submit" name="view" style="background-color:green;">view</button>
                                                </form> 
                                                <?PHP
                                                ?></div>
                                              </div>
                                              <?php
                                      }
                                     
                        }
        }
                    }
                    catch(PDOException $e)
                    {
                      $e->getMessage();
                    }     
   }
  ?>
<body>
</body>
<?php 
}
    include "footer.php";
?>