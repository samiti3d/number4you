<?
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

?>