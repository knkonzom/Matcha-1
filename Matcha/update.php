
<?php  

session_start();
$usr_id = $_SESSION['userId'];

if(isset($_POST['update']))
{
    $Username = $_POST['username'];
    $Email = $_POST['email'];
    $aboutme = $_POST['aboutme'];
    $gender = $_POST['gender'];
    $lastNam = $_POST['lastName'];
    $firstName  = $_POST['firstName'];
    $sex_pref = $_POST['SexualPreference'];
    $Oldpwd = $_POST['old-pwd'];
    $Newpwd = $_POST['new-pwd'];
    $RepeatNewPwd = $_POST['repeat-new-pwd'];
    $age = $_POST['age'];

    $str = file_get_contents('https://geolocation-db.com/json/');
    $json = json_decode($str, true);
    $newcity = $json["city"];
    // echo $newcity;
    //  exit();

    if(empty($Oldpwd))
    {        
        header("location: UsersProfile.php?error=entercurrentpwd");
        exit();
    }
    // else if(!filter_var($Email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9 ]*$\/", $Username) )
    // {
    //     header("location: UsersProfile.php?error=invaliduidmail");
    //     exit();
    // }
    // else if(!filter_var($Email, FILTER_VALIDATE_EMAIL))
    // {
    //     header("location: UsersProfile.php?error=invalidmail&uid=".$Username);
    //     exit();
    // }
    // else if(!preg_match("/^[a-zA-Z0-9]*$/", $Username))
    // {
    //     header("location: UsersProfile.php?error=invalidmail&uid=".$Email);
    //     exit();
    // }
    else if ($Newpwd !== $RepeatNewPwd)
    {
        header("location: UsersProfile.php?error=passwordcheck&uid=".$Username."&mail=".$Email);
        exit();
    }
    else 
    {
        
        
        try 
        {
            include "config/database.php";
            $conn = new PDO("mysql:host=$DB_DSN;dbname=matcha2", $DB_USER, $DB_PASSWORD);
            

            $sql = " SELECT * FROM users WHERE UsersId = '$usr_id' ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            
            echo "$usr_id";
            
            if($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
               
                 $oldpwdCheck = password_verify($Oldpwd, $row["usersPassword"]);
                if($oldpwdCheck === false)
                {
                    
                    header("location: UsersProfile.php?error=old-pwd-not-match-current-pwd");
                    exit();
                }
                else if($oldpwdCheck === true)
                {
                    
                    $verifyID = $row['UsersId'];
                    $newuser = $row['username'];
                    
                    if($Username)
                    {
                        $sql = "UPDATE users SET  username=? WHERE UsersId='$usr_id'";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(1, $Username);
                        $stmt->execute();
                        
                        $sql = " SELECT * FROM users WHERE UsersId='$usr_id'";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();

                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $_SESSION['newusername'] =  $row['username'];
                        
                        

                        $sql = "SELECT * FROM webcamimage WHERE update_userId='$usr_id' ";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $res = $stmt->rowCount();
                    
                        if($res > 0)
                        {
                                $sql = "UPDATE webcamimage SET username='{$_SESSION['newusername']}' WHERE update_userId='$usr_id'  ";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();                               
                        }

                        $sql = "SELECT * FROM profileupdate WHERE update_userId='$usr_id' ";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $res = $stmt->rowCount();
                    
                        if($res > 0)
                        {
                                $sql = "UPDATE profileupdate SET username='{$_SESSION['newusername']}' WHERE update_userId='$usr_id'  ";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();                               
                        }


                    }
                    else if($Email)
                    {
                        $sql = "UPDATE users SET  usersEmail=? WHERE UsersId='$usr_id'";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(1, $Email);
                        $stmt->execute();

                        $sql = " SELECT * FROM users WHERE UsersId='$usr_id'";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();

                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $_SESSION['newuseremail'] =  $row['userEmail'];
                       

                        $sql = "SELECT * FROM webcamimage WHERE update_userId='$usr_id' ";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $res = $stmt->rowCount();
                    
                        if($res > 0)
                        {
                                $sql = "UPDATE webcamimage SET userEmail='{$_SESSION['newuseremail']}' WHERE update_userId='$usr_id'  ";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();  
                                 
                        }
                    }
                    else if($lastNam)
                    {
                        $sql = "UPDATE users SET  usersLastName=? WHERE UsersId='$usr_id'";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(1, $lastNam);
                        $stmt->execute();
                    }
                    else if($firstName)
                    {
                        $sql = "UPDATE users SET  usersFirstName=? WHERE UsersId='$usr_id'";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(1, $firstName );
                        $stmt->execute();
                    }
                    else if($Newpwd)
                    {
                        $newPwdHash = password_hash($Newpwd, PASSWORD_DEFAULT);

                        $sql = "UPDATE users SET usersPassword=? WHERE UsersId='$usr_id'";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(1, $newPwdHash);
                        $stmt->execute();
                    }
                    else
                    {  
                            $sql = "SELECT update_userID FROM profileupdate WHERE update_userId = '$verifyID' ";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();

                            $res = $stmt->rowCount();
                            if($res > 0)
                            {
                              

                                if($aboutme)
                                {
                                    $sql = "UPDATE profileupdate SET AboutMe='$aboutme' WHERE update_userId='$usr_id'  ";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();                                                                  
                                }
                                if($gender)
                                {
                                        $sql = "UPDATE profileupdate SET Gender='$gender' WHERE update_userId='$usr_id'  ";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->execute();
                                    
                                }
                                if($sex_pref)
                                {
                                        $sql = "UPDATE profileupdate SET sexualPreference='$sex_pref' WHERE update_userId='$usr_id'  ";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->execute();                   
                                }
                                if($age)
                                {
                                        $sql = "UPDATE profileupdate SET Age='$age' WHERE update_userId='$usr_id'  ";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->execute(); 
                        
                                }
                            } 
                            else
                            {
                                try
                                {            
                                    $sql2 = "INSERT INTO profileupdate (update_userId, AboutMe, Gender, sexualPreference, username, `Location`, Age, fame) VALUES ('{$verifyID}', '{$aboutme}', '{$gender}', '{$sex_pref}', '{$newuser}', '{$newcity}', '{$age}', 1)";
                                    $stm = $conn->prepare($sql2);
                                    $stm->execute();

                                }
                                catch(PDOException $e)
                                {
                                    echo $e->getMessage();
                                }  
                            }    
                           
                    }

                     header("location: UsersProfile.php?updatesuccess=updated");
                    exit();               
                }
                else
                {
                    echo "Your old password must be match with your current password or try reset your password from login page.";
                    exit();
                }
            }
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
        $conn = null;
       
    }
}
else
{
    header("location: ../index.php");
    exit();
}
?>

