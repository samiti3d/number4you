<?php  error_reporting(0); 
    include ('module/connect.php');
    include ('module/function.php');
    session_start();

$username = $_POST["username"];
$password = $_POST["password"];

$selectAdmin = Select("nfy_admin", "where Username ='" . $username . "'and Password ='" . $password ."')";
$num_rows = Num_Rows($selectAdmin);


    if($num_rows == 1){
    	$_SESSION['Admin']=$username;
    	echo "<script language=\"javascript\">";
    	echo "window.location='index.php';";
    	echo "</script>";
    }else{
    	echo "<script language=\"javascript\">";
    	echo "alert('".$username." นี้ไม่มีอยู่ในระบบ');";
    	echo "window.location='index.php';";
    	echo "</script>";
    }


?>

