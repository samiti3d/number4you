<?php  error_reporting(0); 
    session_start(); 
    include ('module/connect.php');
    include ('module/function.php');

    if(!isset($_SESSION['Admin'])){
        echo "<script language=\"javascript\">";
        echo "alert('กรุณาล๊อคอินเข้าสู้ระบบ');";
        echo "window.location='index.php';";
        echo "</script>";
    }
?>
<?php 
        $sql = "SELECT* FROM nfy_order";
 		$i = 0;
        $r = mysql_query($sql);
        	while ($a = mysql_fetch_array($r)) {
        		$i++;
        		if($a['Csex'] == 1){ $sex = "ชาย";}else{ $sex = "หญิง";}

        		$customerOutput .= '<tr>';
        		$customerOutput .= '<td>'.  $i  .'</td>';
        		$customerOutput .= '<td>'.  $a['Cname']  .'</td>';
        		$customerOutput .= '<td>'.  $a['Clastname']  .'</td>';
        		$customerOutput .= '<td>'. 	$sex .'</td>';
        		$customerOutput .= '<td>'.  $a['Cemail']  .'</td>';
        		$customerOutput .= '<td>'.  $a['Caddress']  .'</td>';
        		$customerOutput .= '<td>'.  $a['Ctel']  .'</td>';
        		$customerOutput .= '<td>ทั่วไป</td>';
        		$customerOutput .= '<td class="align-center"><a href="?Act=del&name='. $a['Cname'] .'">X</a></td>';
        		$customerOutput .= '</tr>';

        	}

        $name = trim($_GET['name']);
		switch ($_GET['Act']) {
			case 'del':
				Delete('nfy_order',"WHERE Cname = '$name'");
				header("Location: customer.php");
				exit(0);
				break;
			
			default:
				break;
		}
?>
<?php include("elements/header.php");?>

    <body class="bootstrap-admin-with-small-navbar">
        <!-- small navbar -->
<?php include("elements/small_nav.php"); ?>

        <!-- main / large navbar -->
<?php include("elements/big_nav.php"); ?>

        <div class="container">
            <!-- left, vertical navbar & content -->
            <div class="row">
                <!-- left, vertical navbar -->
                <?php include("admin_menu.php");?>
                        <div class="col-lg-10">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">รายชื่อลูกค้า</div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <p style="color: red;">สถานะทั่วไปคือบุคุลที่ไม่ได้เป็นสมาชิก</p>

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#อันดับ</th>
                                                <th>ชื่อ</th>
                                                <th>นามสกุล</th>
                                                <th>เพศ</th>
                                                <th>อีเมล</th>
                                                <th>ที่อยู่จัดส่ง</th>
                                                <th>เบอร์โทรศัพท์</th>
                                                <th>สถานะ</th>
                                                <th>ลบ</th>

                                            </tr>
                                            <?php echo $customerOutput; ?>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                <!-- content -->

                </div>
            </div>
        </div>

        <!-- footer -->
<?php include("elements/footer.php"); ?>