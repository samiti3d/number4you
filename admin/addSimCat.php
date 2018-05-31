<?php  
	ob_start();
	error_reporting(0); 
    session_start(); 
    include ('module/connect.php');
    include ('module/function.php');
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>add sim</title>
    </head>



<?php 


$berCatsAdd = trim($_POST['ber_cats_add']);

if (empty($berCatsAdd)) {
	echo "ตรวจพบค่าว่าง";
	header('Location: simcat.php');
	exit();
}
$sql = "SELECT * FROM nfy_cats WHERE catname = $berCatsAdd";
$r = mysql_query($sql);
$row = mysql_num_rows($r);

if ($row > 1) {
    echo "<script language=\"javascript\">";
    echo "alert('ใส่ข้อมูลซ้ำ!');";
    echo "window.location='simcat.php';";
    echo "</script>";
    exit();

}else{

$insertCat = Insert('nfy_cats', "0,'$berCatsAdd'");

    echo "<script language=\"javascript\">";
    echo "alert('เพิ่มหมวดหมู่เรียบร้อย!');";
    echo "window.location='simcat.php';";
    echo "</script>";
    exit();

}

?> 


</html>