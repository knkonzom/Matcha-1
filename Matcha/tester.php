
    <?PHP 
     $str = file_get_contents('https://geolocation-db.com/json/');
     $json = json_decode($str, true);
     echo $json["city"];
    ?>




