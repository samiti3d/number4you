<?  error_reporting(0); 
    session_start(); 
    include ('module/connect.php');
    include ('module/function.php');?>

<!DOCTYPE html>
<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>Admin Area</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="robots" content="noindex,nofollow">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap -->
        <link rel="stylesheet" media="screen" href="css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="css/bootstrap-theme.min.css">

        <!-- Bootstrap Admin Theme -->
        <link rel="stylesheet" media="screen" href="css/bootstrap-admin-theme.css">

        <!-- Custom styles -->
        <style type="text/css">
            .alert{
                margin: 0 auto 20px;
            }
        </style>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
           <script type="text/javascript" src="js/html5shiv.js"></script>
           <script type="text/javascript" src="js/respond.min.js"></script>
        <![endif]-->
        <script language="javascript" src="module/function.js"></script>
<script language="javascript">
    function CheckValue(){
        if(document.getElementById('Username').value == ""){
            alert('กรุณากรอก Username');
            document.getElementById('Username').focus();
            return false;
        }
        if(document.getElementById('Password').value == ""){
            alert('กรุณากรอก Password');
            document.getElementById('Password').focus();
            return false;
        }
    }
</script>
    </head>
    <body class="bootstrap-admin-without-padding">
    <?
    $Act=$_GET['Act'];
    switch($Act){
        case 'Check' :    $Username=$_POST['Username'];
                            $Password=$_POST['Password'];
                            $SelectAdmin=Select("nfy_admin","WHERE Username='".$Username."' AND Password='".$Password."'");
                            $Num_Rows=Num_Rows($SelectAdmin);
                            if($Num_Rows == 1){
                                $_SESSION['Admin']=$Username;
                                echo "<script language=\"javascript\">";
                                echo "window.location='about.php';";
                                echo "</script>";
                            }else{
                                echo "<script language=\"javascript\">";
                                echo "alert('".$Username." นี้ไม่มีอยู่ในระบบ');";
                                echo "window.location='index.php';";
                                echo "</script>";
                            }
    }

?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-info">
                        <a class="close" data-dismiss="alert" href="#">&times;</a>
                        ยินดีต้อนรับสู่ Admin Area!
                    </div>
                    <form method="post" action="?Act=Check" class="bootstrap-admin-login-form">
                        <h1>ล็อคอิน</h1>
                        <div class="form-group">
                            <input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="password" name="Password" id="Password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="remember_me">
                                Remember me
                            </label>
                        </div>
                        <button class="btn btn-lg btn-primary" type="submit" onclick="return CheckValue()">ตกลง</button>
                    </form>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(function() {
                // Setting focus
                $('input[name="email"]').focus();

                // Setting width of the alert box
                var alert = $('.alert');
                var formWidth = $('.bootstrap-admin-login-form').innerWidth();
                var alertPadding = parseInt($('.alert').css('padding'));

                if (isNaN(alertPadding)) {
                    alertPadding = parseInt($(alert).css('padding-left'));
                }

                $('.alert').width(formWidth - 2 * alertPadding);
            });
        </script>
    </body>
</html>
