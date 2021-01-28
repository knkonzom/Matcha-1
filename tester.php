<?php

/*** our string ***/
$string = "?><!@#$%^&*()}{~bobthebuilder";

/*** echo the sanitized string ***/
echo filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS)."<br>";



?>

<?php

date_default_timezone_set('Africa/Johannesburg');
$current_timestamp = date('H:i:s');
echo $current_timestamp;
?>

<?PHP
