<?php
session_start();
error_reporting(E_ALL); 
include_once('admin/module/connect.php');
include_once('admin/module/function.php');
if (!isset($_SESSION['Memberx']) && empty($_SESSION['Memberx'])) {
    header("Location: index.php");
    exit();
}
if ($act = $_GET['Act']) {
  switch ($act) {
    case 'exit':
    session_destroy();
    header("Location: index.php");
      break;

    default:

      break;
  }
}
  $sqlname = $_SESSION['Memberx'];
  $sql = "SELECT * FROM nfy_member WHERE m_username ='$sqlname'";
  $r = mysql_query($sql);
  while($a = mysql_fetch_array($r)) {
    $id = $a['id'];
    $name = $a['m_name'];
    $surname = $a['m_last'];
    $email = $a['m_email'];
    $address = $a['m_address'];
    $tel = $a['m_tel'];
  } 

  $sql_payer = "SELECT * FROM nfy_payer WHERE payer_member = $'$sqlname'";
  $r_payer = mysql_query($sql_payer);
  while ($a_payer = mysql_fetch_array($r_payer)) {
    $orderinfo = $a_payer['payer_member'];
  }

?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/ico/favicon.png">
<title>ระบบสมาชิก NumberForYou.net</title>
<!-- Bootstrap core CSS -->
<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="assets/css/style.css" rel="stylesheet">

<!-- styles needed for carousel slider -->
<link href="assets/css/owl.carousel.css" rel="stylesheet">
<link href="assets/css/owl.theme.css" rel="stylesheet">

<!-- Just for debugging purposes. -->
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<!-- include pace script for automatic web page progress bar  -->

<script>
    paceOptions = {
      elements: true
    };
</script>
<script src="assets/js/pace.min.js"></script>
</head>
<body>
<div id="wrapper">
  <div class="header">
    <nav class="navbar navbar-site navbar-default" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          <a href="index.php" class="navbar-brand logo logo-title"> 
          <!-- Original Logo will be placed here  --> 
          <span class="logo-icon"><i class="icon icon-search-1 ln-shadow-logo shape-0"></i> </span> N<span>umberforyou </span> </a> </div>
        <div class="navbar-collapse collapse">
          
          <ul class="nav navbar-nav navbar-right">
            <li><a href="?Act=exit">ลงชื่อออก <i class="glyphicon glyphicon-off"></i> </a></li>
            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span>
            <?php echo $_SESSION['Memberx']; ?></span> <i class="icon-user fa"></i> <!-- <i class=" icon-down-open-big fa"></i> --></a>
<!--               <ul class="dropdown-menu user-menu">
                <li class="active"><a href="account-home.html"><i class="icon-home"></i> ระบบหน้าสมาชิก </a></li>
                
                <li><a href="account-myads.html"><i class="icon-th-thumb"></i> My ads </a></li>
                <li><a href="account-favourite-ads.html"><i class="icon-heart"></i> Favourite ads </a></li>
                <li><a href="account-saved-search.html"><i class="icon-star-circled"></i> Saved search </a></li>
                <li><a href="account-archived-ads.html"><i class="icon-folder-close"></i> Archived ads </a></li>
                <li><a href="account-pending-approval-ads.html"><i class="icon-hourglass"></i> Pending approval </a></li>
                <li><a href="statements.html"><i class=" icon-money "></i> Payment history </a></li>
              </ul> -->
            </li>
            <li class="postadd"><a class="btn btn-block   btn-border btn-post btn-danger" href="index.php">เลือกซื้อซิมมงคล</a></li>
          </ul>
        </div>
        <!--/.nav-collapse --> 
      </div>
      <!-- /.container-fluid --> 
    </nav>
  </div>
  <!-- /.header -->
  
  <div class="main-container">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 page-sidebar">
          <aside>
            <div class="inner-box">
              <div class="user-panel-sidebar">
                <div class="collapse-box">
                  <h5 class="collapse-title no-border"> หน้าระบบสมาชิก <a href="#MyClassified" data-toggle="collapse" class="pull-right"><i class="fa fa-angle-down"></i></a></h5>
                  <div class="panel-collapse collapse in" id="MyClassified">
                    <ul class="acc-list">
                      <li><a class="active" href="account-home.php"><i class="icon-home"></i> หน้าแรก </a></li>
                      
                    </ul>
                  </div>
                </div>
                <!-- /.collapse-box  -->
                <div class="collapse-box">
                  <h5 class="collapse-title"> เครื่องมือ <a href="#MyAds" data-toggle="collapse" class="pull-right"><i class="fa fa-angle-down"></i></a></h5>
                  <div class="panel-collapse collapse in" id="MyAds">
                    <ul class="acc-list">
                      <li><a href="account-myads.html"><i class="icon-docs"></i> แจ้งชำระเงิน <span class="badge">42</span> </a></li>
                      <li><a href="memberorder.php"><i class="icon-heart"></i> ตรวจสอบสถานะสั่งซื้อ <span class="badge">42</span> </a></li>
                      <li><a href="account-saved-search.html"><i class="icon-star-circled"></i> แสดงความคิดเห็น <span class="badge">42</span> </a></li>
                    </ul>
                  </div>
                </div>
                <!-- /.collapse-box  -->
                
<!--                 <div class="collapse-box">
                  <h5 class="collapse-title"> Terminate Account <a href="#TerminateAccount" data-toggle="collapse" class="pull-right"><i class="fa fa-angle-down"></i></a></h5>
                  <div class="panel-collapse collapse in" id="TerminateAccount">
                    <ul class="acc-list">
                      <li><a href="account-close.html"><i class="icon-cancel-circled "></i> Close account </a></li>
                    </ul>
                  </div>
                </div> -->
                <!-- /.collapse-box  --> 
              </div>
            </div>
            <!-- /.inner-box  --> 
            
          </aside>
        </div>
        <!--/.page-sidebar-->
        
        <div class="col-sm-9 page-content">
                                            <?php  if (isset($errors) && !empty($errors)) {
              echo '<div class="alert alert-warning">';
              echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
              echo '<ul><li>', implode('</li><li>', $errors) ,'</li></ul>';
              echo '</div>';
            }?>
          <div class="inner-box">
          <div class="row">
            <div class="col-md-5 col-xs-4 col-xxs-12">
              <h3 class="no-padding text-center-480 useradmin"><img class="userImg" src="images/user.jpg" alt="user"> ชื่อ Username:  <a href="#"><?php echo $_SESSION['Memberx']; ?> </a> </h3>
            </div>
            <div class="col-md-7 col-xs-8 col-xxs-12">
              <div class="header-data text-center-xs"> 
                

              </div>
            </div>
          </div>
          </div>
          
          <div class="inner-box">
            <div class="welcome-msg">
              <h3 class="page-sub-header2 clearfix no-padding">สวัสดีคุณ <?php echo $_SESSION['Memberx']; ?> </h3>
              <?php 

              $sql = "SELECT * FROM nfy_checkin WHERE m_id = $id";
              $r = mysql_query($sql);
              $row = mysql_num_rows($r);
              $pointer = $row - 1;

              $mysql = "SELECT * FROM nfy_checkin ORDER BY m_id DESC LIMIT 0, $pointer";
              $result = mysql_query($mysql);

              while ($b = mysql_fetch_array($result)) {
                $login = $b['login'];
              }
               

              ?>
              <span class="page-sub-header-sub small">คุณล็อคอินล่าสุดเมื่อ: <?php echo $login; ?></span> </div>
            <div id="accordion" class="panel-group">
            <?php echo $orderinfo; ?>
            </div>
            <!--/.row-box End--> 
            
          </div>
        </div>
        <!--/.page-content--> 
      </div>
      <!--/.row--> 
    </div>
    <!--/.container--> 
  </div>
  <!-- /.main-container -->
  
<?php include('template_elements/template_footer.php'); ?>