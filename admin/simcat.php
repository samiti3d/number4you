<?php  error_reporting(0); 
    session_start(); 
    include ('module/connect.php');
    include ('module/function.php');?>

<?php include("elements/header.php");?>

<script language="javascript">
    function CheckValue(){
        if(document.getElementById('ber_cats_add').value == ""){
        alert('กรุณากรอกหมวดหมู่ที่ต้องการ');
        document.getElementById('ber_cats_add').focus();
        return false;
            }
    }
</script>

<?php 
        $Act = $_GET['Act'];
        $cid = $_GET['cid'];
        $pid = $_GET['pid'];

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
                echo "alert('คุณยกเลิกแบบฟอร์ม');";
                echo "window.location='simcat.php';";
                echo "</script>";
                exit();
                break;


             case 'del':
                if (isset($cid)&&isset($pid)) {

                    if ($pid == 3) {

                    Delete("nfy_cats","where id = $cid");

                    echo "<script language=\"javascript\">";
                    echo "alert('คุณลบหมวดหมู่เบอร์โทรเรียบร้อยแล้ว!');";
                    echo "window.location='simcat.php';";
                    echo "</script>";
                    exit();

                    }

                }
            
            default:
                
                break;
        }

    ?>

<?php
    if(!isset($_SESSION['Admin'])){
        echo "<script language=\"javascript\">";
        echo "alert('กรุณาล๊อคอินเข้าสู้ระบบ');";
        echo "window.location='index.php';";
        echo "</script>";
    }else{
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
                <?php include("form_cat.php");?>

                </div>
            </div>
        </div>
<?php include("elements/footer.php"); ?>

<?php }?>
