<!DOCTYPE html>
<html>
    <head>
        <title>ระบบค้นหาเบอร์โทรศัพท์</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="noindex,nofollow">

        <!-- Bootstrap -->
        <link rel="stylesheet" media="screen" href="css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="css/bootstrap-theme.min.css">

        <!-- Bootstrap Admin Theme -->
        <link rel="stylesheet" media="screen" href="css/bootstrap-admin-theme.css">
        <link rel="stylesheet" media="screen" href="css/bootstrap-admin-theme-change-size.css">

        <!-- Vendors -->
        <link rel="stylesheet" media="screen" href="vendors/bootstrap-datepicker/css/datepicker.css">
        <link rel="stylesheet" media="screen" href="css/datepicker.fixes.css">
        <link rel="stylesheet" media="screen" href="vendors/uniform/themes/default/css/uniform.default.min.css">
        <link rel="stylesheet" media="screen" href="css/uniform.default.fixes.css">
        <link rel="stylesheet" media="screen" href="vendors/chosen.min.css">
        <link rel="stylesheet" media="screen" href="vendors/selectize/dist/css/selectize.bootstrap3.css">
        <link rel="stylesheet" media="screen" href="vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/stylesheets/bootstrap-wysihtml5/core-b3.css">
        <!-- (...) -->

        <!-- CDN -->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
           <script type="text/javascript" src="js/html5shiv.js"></script>
           <script type="text/javascript" src="js/respond.min.js"></script>
        <![endif]-->
<script type="text/javascript">
$('.nav li a').on('click', function() {
    alert('clicked');
    $(this).parent().parent().find('.active').removeClass('active');
    $(this).parent().addClass('active');
});
</script>
<script language="javascript">
    function CheckValue(){
        if(document.getElementById('ber').value == ""){
            alert('กรุณากรอกเบอร์โทรศัพท์');
            document.getElementById('ber').focus();
            return false;
        }
        if(document.getElementById('ber_price').value == ""){
            alert('ไม่ได้ใส่ราคา');
            document.getElementById('ber_price').focus();
            return false;
        }
    }
</script>
<?php 
        $Act = $_GET['Act'];
        $id = $_GET['id'];
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


    </head>