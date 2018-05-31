<?  
session_start();
error_reporting(0); 

    include_once('admin/module/connect.php');
    include_once('admin/module/function.php');
    $current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>

<?php 

$br = $_POST['ber'];

$number = "0928796292";


if (isset($number) && $number != "") {

$i = 1; 
$test = str_split($number);

	for ($i=0; $i <= 8 ; $i++) { 
	
		$tarray[] = array_splice($test, $i, 2);
		$number = "0928796292";
		$test = str_split($number);

	}

}
	// for ($i=1; $i <8 ; $i++) { 

 //    $itest[] = implode("", $tarray[$i]);


	// }

	// for ($i=1; $i <8 ; $i++) {

	// $sql = "SELECT * FROM nfy_luck WHERE $luckid = $tarray[$i]";
	// $r = mysql_query($sql);

	// 	if ($row = mysql_fetch_array($r)) {

	// 		$luckOutput .= $row['lucknum'];

	// 	}

	// }

	echo "<pre>";

  	print_r($tarray);

	echo "</pre>";

	// echo $itest[0];

?>



