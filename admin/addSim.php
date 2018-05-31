<?php  
	error_reporting(0); 
    session_start(); 
    include ('module/connect.php');
    include ('module/function.php');
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>เพิ่มซิมใหม่</title>
    </head>

<?php 
        // get values
		$ber = $_POST['ber'];
        $berCat = $_POST['ber_cat'];
        $berPro = $_POST['ber_pro'];
        $berShow = $_POST['ber_show'];
		$berPrice = $_POST['ber_price'];

        // check nums

        if (!is_numeric($ber) && $ber !="") {
            
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

        //add to database
    if (isset($ber) && $ber !="") {

        $selectedSims = Select("nfy_sims","where sims_ber = $ber");
        $Num_Rows=Num_Rows($selectedSims);
        if ($Num_Rows > 1) {

                echo "<script language=\"javascript\">";
                echo "alert('ข้อมูลซ้ำ');";
                echo "window.location='simmanagement.php';";
                echo "</script>";
                exit();
        }else{

        $insertSims = Insert('nfy_sims',"0,'$ber','$berCat','$berPro',$berShow,$berPrice,$sumBer");

                echo "<script language=\"javascript\">";
                echo "alert('นำเข้าข้อมูลสำเร็จ!');";
                echo "window.location='simmanagement.php';";
                echo "</script>";
                exit();

        }
    }
        


?>

</html>