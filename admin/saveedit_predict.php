<?php  
    session_start(); 
	error_reporting(0); 
    include ('module/connect.php');
    include ('module/function.php');
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>แก้ไขคำทำนาย</title>
    </head>

<?php 

    $eberku = trim($_POST['eberku']);
    $ebertumnai = trim($_POST['ebertumnai']);

    if (isset($eberku) && $eberku != "") {
    
            $checkUpdate = Update('nfy_tamnai',"tamnai_ber='$eberku',tamnai_text='$ebertumnai' WHERE tamnai_ber = $eberku");

            if ($checkUpdate) {

            echo "<script language=\"javascript\">";
            echo "alert('Update Complete!');";
            echo "window.location='numberpredict.php';";
            echo "</script>";
            exit();
            }
    }


?>

</html>