
   
   


<?php

$arr1 = array("46", "capetown", "money");
$arr2 = array("46", "capetown", "mone");
if(array_intersect($arr1, $arr2) == TRUE)
{
   echo "true";
}
else
{
    echo "false";
}
?>



