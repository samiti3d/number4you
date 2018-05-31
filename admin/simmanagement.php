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
<?php include("elements/header.php");?>

<?php 
        $Act = $_GET['Act'];
        $id = $_GET['id'];
        $pid = $_GET['pid'];
        $cancel = $_GET['cancel'];

        switch ($Act) {
            case 'logout':
                session_destroy();
                echo "<script language=\"javascript\">";
                echo "alert('คุณลงชื่ออกจากระบบเรียบร้อยแล้ว');";
                echo "window.location='index.php';";
                echo "</script>";
                exit();

                break;

            case 'cancel':
                echo "<script language=\"javascript\">";
                echo "alert('คุณยกเลิกกรอกแบบฟอร์ม');";
                echo "window.location='simmanagement.php';";
                echo "</script>";
                exit();
                break;


             case 'del':
                if (isset($id)&&isset($pid)) {

                    if ($pid == 2) {

                    Delete("nfy_sims","where sims_id = $id");

                    echo "<script language=\"javascript\">";
                    echo "alert('คุณลบรายการเบอร์โทรเรียบร้อยแล้ว!');";
                    echo "window.location='simmanagement.php';";
                    echo "</script>";
                    exit();

                    }

                }
            
            default:
                
                break;
        }

    ?>
    <body class="bootstrap-admin-with-small-navbar">
        <!-- small navbar -->
<?php include("elements/small_nav.php"); ?>

        <!-- main / large navbar -->
<?php include("elements/big_nav.php"); ?>

        <div class="container">
            <!-- left, vertical navbar & content -->
            <div class="row">
                <!-- left, vertical navbar -->

                <!-- content -->
                <?php include("forms.php");?>

                </div>
            </div>
        </div>

        <!-- footer -->
<?php include("elements/footer.php"); ?>
