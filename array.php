<?php 

$a1=array("a"=>"red");
$a2=array("a"=>"purple");
array_splice($a1,-1,1,$a2);

 
echo "<pre>";
 print_r($a1);

echo "</pre>";
?>