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
        $sql = "SELECT* FROM nfy_payer";
        $i = 0;
        $r = mysql_query($sql);
            while ($a = mysql_fetch_array($r)) {
                $i++;
                if ($a['payment_type'] == 1) {
                    $payment = "ATM";
                }
                $thtober = explode(",", $a['product_id_array']);
                // foreach ($thtober as $thber) {
                // $st = "SELECT * FROM nfy_sims WHERE sims_id = {$thber}";
                // $rt = mysql_query($st);
                //     while ($thberorder = mysql_fetch_array($rt)) {

                //         $tableber[] = $thberorder['sims_ber'];
                //     }
                // }
                $tableber = count($thtober);

                $customerOutput .= '<tr>';
                $customerOutput .= '<td>'.  $i  .'</td>';
                $customerOutput .= '<td>'.  $a['payer_orderid']  .'</td>';
                $customerOutput .= '<td>'.  $tableber  .'</td>';
                $customerOutput .= '<td>'.  $a['payer_email']  .'</td>';
                $customerOutput .= '<td>'.  $a['payer_firstname']  .'</td>';
                $customerOutput .= '<td>'.  $a['payer_address']  .'</td>';
                $customerOutput .= '<td>'.  $a['payer_tel']  .'</td>';
                $customerOutput .= '<td>'.  $payment .'</td>';
                $customerOutput .= '<td><span style="color: red;">'.  $a['payment_status']  .'</span></td>';
                $customerOutput .= '<td>'.  number_format($a['mc_gross']) .'</td>';
                $customerOutput .= '<td>'.  $a['payer_member']  .'</td>';
                $customerOutput .= '<td class="align-center"><a href="?Act=edit&id='. $a['id'] .'">แก้ไข</a></td>';
                $customerOutput .= '</tr>';

            }

        $name = trim($_GET['name']);
        $oid = trim($_GET['hiddenid']);
        $status = trim($_GET['statusselected']);
        if (isset($status) && $status != "") {
            switch ($status) {
                case '2':
                    $status = "complete";
                    Update('nfy_payer', "payment_status='$status' WHERE id ='$oid'");
                    echo "<script language=\"javascript\">";
                    echo "window.location='order.php';";
                    echo "</script>";
                    exit();
                    break;
                case '1':
                    $status = "pending";
                    Update('nfy_payer', "payment_status='$status' WHERE id ='$oid'");
                    echo "<script language=\"javascript\">";
                    echo "window.location='order.php';";
                    echo "</script>";
                    exit();                    
                    break;
                
                default:
                    # code...
                    break;
            }
        }
        switch ($_GET['Act']) {
            case 'del':
                Delete('nfy_order',"WHERE Cname = '$name'");
                header("Location: customer.php");
                exit(0);
                break;
            case 'edit':
                $id = $_GET['id'];
                $sql = "SELECT * FROM nfy_payer WHERE id = $id";
                $r = mysql_query($sql);
                while ($a = mysql_fetch_array($r)) {
                    $each_ber = explode(",", $a['product_id_array']);
                    foreach ($each_ber as $ber) {
                        $select = "SELECT * FROM nfy_sims WHERE sims_id = $ber";
                        $result = mysql_query($select);
                        while ($berorder = mysql_fetch_array($result)) {
                            $buyber[] = $berorder['sims_ber'];
                        }
                    }

                    $editOutput .= '<form method="get" action="">';
                    $editOutput .= '<label>ใบสั่งซื้อเลขที่</label>: ';
                    $editOutput .= $a['payer_orderid'] .'<br>';
                    $editOutput .= '<label>เบอร์ที่ซิ้อ</label>: ';
                    $editOutput .= $berOutput = implode(",",$buyber) . '<br>';
                    $editOutput .= '<label>สถานะการจ่ายเงิน</label>: '. $a['payment_status'] . '<br>';
                    $editOutput .= 'แก้ไขสถานะ: ';
                    $editOutput .= '<select name="statusselected">';
                    $editOutput .= '<option value="1">pending</option> ';
                    $editOutput .= '<option value="2">complete</option>';
                    $editOutput .= '</select><br><br>';
                    $editOutput .= '<input type="hidden" name="hiddenid" value="'. $a['id'] .'">';
                    $editOutput .= '<input type="submit" value="submit">';
                    $editOutput .= '</form><br><br>';               
                }

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
                        <div class="col-lg-12">
                            <?php if (isset($editOutput) && $editOutput != "") {
                                echo "<h3>ฟอร์มแก้ไขคำสั่งซื้อ</h3>";
                                echo $editOutput;
                            } ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">รายการสั่งซื้อที่มาถึง</div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#ลำดับที่</th>
                                                <th>#OrderID</th>
                                                <th>จำนวนเบอร์ที่ซื้อ</th>
                                                <th>อีเมล</th>
                                                <th>ชื่อ</th>
                                                <th>ที่อยู่จัดส่ง</th>
                                                <th>เบอร์โทรศัพท์</th>
                                                <th>วิธีจ่ายเงิน</th>
                                                <th>ขั้นตอน</th>
                                                <th>ยอดรวม</th>
                                                <th>สมาชิก</th>
                                                <th>ดำเนินการ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php echo   $customerOutput; ?>
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