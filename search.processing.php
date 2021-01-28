<?php
session_start();

include "config/database.php";
$conn = new PDO("mysql:host=$DB_DSN;dbname=matcha", $DB_USER, $DB_PASSWORD);


// if(isset($_POST['searchadvanced']))
// {
//     $stmt = "SELECT * FROM profileupdate WHERE `Age` LIKE ? OR `Location` LIKE ? OR `Interest` LIKE ?'";
//     $stmt = $conn->prepare($sql);
//     $stmt->execute();
//     echo "Passed this Point";
//     $results = $stmt->fetchAll();



//     // [SEARCH RESULTS]

//     if (count($results) > 0) {
//         foreach ($results as $r) {
//           printf("<div>%s - %s</div>", $r['Age'], $r['Location'], $r['Interest']);
//         }
//       } else {
//         // echo "No results found";
//       }
// }
// // header("Location:browseProfile.php");






if(isset($_POST['searchadvanced']))
{
    $sql = "SELECT * FROM profileupdate WHERE `Age` LIKE '?' OR `Location` LIKE '?'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    echo "Passed this Point";
    $results = $stmt->fetchAll();
    echo "Passed this Point";

        if (count($results) > 0) {
        foreach ($results as $r) {
          printf("<div>%s - %s</div>", $r['Age'], $r['Location']);
        }
      } else {
        header("Location:browseProfile.php?empty=noresultfound");
        echo "No results found";
      }
}

// header("Location:browseProfile.php");




?>


