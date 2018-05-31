<?  error_reporting(0); 
    session_start(); 
    include ('module/connect.php');
    include ('module/function.php');?>
<!DOCTYPE html>
<html>
    <head>
        <title>About | Admin Area</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap Docs -->
        <!-- <link href="http://getbootstrap.com/docs-assets/css/docs.css" rel="stylesheet" media="screen"> -->

        <!-- Bootstrap -->
        <link rel="stylesheet" media="screen" href="css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="css/bootstrap-theme.min.css">

        <!-- Bootstrap Admin Theme -->
        <link rel="stylesheet" media="screen" href="css/bootstrap-admin-theme.css">
        <link rel="stylesheet" media="screen" href="css/bootstrap-admin-theme-change-size.css">

        <!-- Custom styles -->
        <style type="text/css">
            @font-face {
                font-family: Ubuntu;
                src: url('fonts/Ubuntu-Regular.ttf');
            }
            .bs-docs-masthead{
                background-color: #6f5499;
                background-image: linear-gradient(to bottom, #563d7c 0px, #6f5499 100%);
                background-repeat: repeat-x;
            }
            .bs-docs-masthead{
                padding: 0;
            }
            .bs-docs-masthead h1{
                color: #fff;
                font-size: 40px;
                margin: 0;
                padding: 34px 0;
                text-align: center;
            }
            .bs-docs-masthead a:hover{
                text-decoration: none;
            }
            .meritoo-logo a{
                background-color: #fff;
                border: 1px solid rgba(66, 139, 202, 0.4);
                display: block;
                font-family: Ubuntu;
                padding: 22px 0;
                text-align: center;
            }
            .meritoo-logo a,
            .meritoo-logo a:hover,
            .meritoo-logo a:focus{
                text-decoration: none;
            }
            .meritoo-logo a img{
                display: block;
                margin: 0 auto;
            }
            .meritoo-logo a span{
                color: #4e4b4b;
                font-size: 18px;
            }
            .row-urls{
                margin-top: 4px;
            }
            .row-urls .col-md-6{
                text-align: center;
            }
            .row-urls .col-md-6 a{
                font-size: 14px;
            }
        </style>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
           <script type="text/javascript" src="js/html5shiv.js"></script>
           <script type="text/javascript" src="js/respond.min.js"></script>
        <![endif]-->
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
 -->
<script type="text/javascript">
$('.nav li a').on('click', function() {
    alert('clicked');
    $(this).parent().parent().find('.active').removeClass('active');
    $(this).parent().addClass('active');
});
</script>
 

    </head>
    <!-- logout -->
    <?php 
        $Act = $_GET['Act'];
        switch ($Act) {
            case 'logout':
                session_destroy();
                echo "<script language=\"javascript\">";
                echo "alert('คุณลงชื่ออกจากระบบเรียบร้อยแล้ว');";
                echo "window.location='index.php';";
                echo "</script>";
                exit();

                break;
            
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
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header bootstrap-admin-content-title">
                                <h1>ยินดีต้อนรับ <?php echo $_SESSION['Admin']; ?></h1>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">รายละเอียดระบบ</div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <ul>
                                        <li>ระบบจัดการซิม</li>
                                        <li>ระบบทำนายเบอร์พื้นฐาน</li>
                                        <li>ระบบตะกร้าสินค้า และแจ้งชำระเงิน</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Source</div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <ul>
                 
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">สร้างโดย ณัฐชานนท์</div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
             
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="bs-docs-masthead">

                            </div>
                        </div>
                        <div class="col-md-6 meritoo-logo">

                        </div>
                    </div>

                    <div class="row row-urls">
                        <div class="col-md-6">
                            <a href="#" target="_blank">โครง twitter Bootstrap 3.x</a>
                        </div>
                        <div class="col-md-6">
                            <a href="#" target="_blank">Numberforyou.net</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer -->
        <div class="navbar navbar-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <footer role="contentinfo">
                            <p class="left">ระบบทำนายเบอร์โทรและจัดการซิม</p>
                            <p class="right">&copy; 2013 <a href="#" target="_blank">Natchanon</a></p>
                        </footer>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-admin-theme-change-size.js"></script>
    </body>

<?php } ?>
</html>

