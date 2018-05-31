<?php  
	error_reporting(0); 
    session_start(); 
    include ('module/connect.php');
    include ('module/function.php');
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Add Sims</title>
    </head>

<?php 
        // get values
		$ber = $_POST['ber'];
        $berCat = $_POST['ber_cat'];
        $berPro = $_POST['ber_pro'];
        $berShow = $_POST['ber_show'];
		$berPrice = $_POST['ber_price'];
        $berid = $_POST['ber_id'];

        // check nums

        if (!is_numeric($ber) || !is_numeric($berPrice)) {
            
                echo "<script language=\"javascript\">";
                echo "alert('พบตัวอักษร');";
                echo "window.location='simmanagement.php';";
                echo "</script>";
                exit();
        }
            
        // calculate total
        $xBer = str_split($ber);
        $sumBer = array_sum($xBer);

        // check ber provider
        switch ($berPro) {
            case '1':
                $berPro = "ais";
                break;
            case '2':
                $berPro = "truemove";
                break;
            case '3':
                $berPro = "dtac";
                break;
            
            default:
                $berPro = "none";
                break;
        }

        // check show homepage
        if ($berShow != 1) {
            $berShow = 0;
        }

        //Update to database

        $sql = "SELECT nfy_sims WHERE sims_ber = $ber";
        $r = mysql_query($sql);
        // $simsNums = mysql_num_rows($r);


        // if ($simsNums > 1) {
        //     echo "<script language=\"javascript\">";
        //     echo "alert('ใส่ข้อมูลซ้ำ!');";
        //     echo "window.location='simmanagement.php';";
        //     echo "</script>";
        //     exit();

        // }else{

        $insertSims = Update('nfy_sims',"sims_ber = '$ber', sims_cat = '$berCat', sims_provider = '$berPro', sims_show = '$berShow', sims_price = '$berPrice', sims_total = '$sumBer' WHERE sims_id = $berid");

                echo "<script language=\"javascript\">";
                echo "alert('อัพเดตสำเร็จ!');";
                echo "window.location='simmanagement.php';";
                echo "</script>";
                exit();

        // }
        


?>

</html>