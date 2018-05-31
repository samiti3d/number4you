<?php  error_reporting(E_ALL); 
$Host='localhost';
$UserHost='root';
$PassHOst='root';
$DB='nfy_db';

$Connect=mysql_connect($Host,$UserHost,$PassHOst);
if($Connect){
	$Select_DB=mysql_select_db($DB);
	if($Select_DB){
		mysql_query("SET NAMES UTF8");
	}else{
		echo "<script language=\"javascript\">";
		echo "alert('Non Select Database : $DB')";
		echo "</script>";
		}
	}else{
		echo "<script language=\"javascript\">";
		echo "alert('Connecting Error()');";
		echo "</script>";
		}

    // include ('admin/module/pmj/lib/IMager/imager.php');

?>
<?php
$id = $_GET['id'];
$sql = "SELECT * FROM image WHERE image_id = $id";
$sth = mysql_query($sql);
$result=mysql_fetch_array($sth);
echo $result['image_content'];
mysql_close($Connect);

header("Content-Type: image/jpeg");
?>