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
<title>ทำนายเบอร์โทรศัพท์มือถือ</title>
<!-- Bootstrap core CSS -->
<link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">

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
<style>
.purple{ color:#C30083; }
.blue{ color:#104BA9; }
.orange{ color:#FFA200; }
.green{ color:#AEF100; }
.action { 
    margin:10px 10px 10px 10px; 
    padding:20px 20px 20px 20px; 
    background-color:#D8D8D8 ; 
    border-radius:3px; 
    border:2px solid green;
    }
.jumbotron {
background: #358CCE;
color: #FFF;
border-radius: 0px;
}
.jumbotron-sm { padding-top: 24px;
padding-bottom: 24px; }
.jumbotron small {
color: #FFF;
}
.h1 small {
font-size: 24px;
}
</style>
</head>
<body>

<div id="wrapper">
  <div class="header">
    <nav class="navbar   navbar-site navbar-default" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          <a href="index.php" class="navbar-brand logo logo-title"> 
          <!-- Original Logo will be placed here  --> 
          <span class="logo-icon"><i class="icon icon-search-1 ln-shadow-logo shape-0"></i> </span> N<span>umberForYou </span> </a> </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
          <?php if (isset($_SESSION['Memberx']) && $_SESSION['Memberx'] !=""){ ?>
            <?php echo '<li><a class="glyphicon glyphicon-off" href="?exit=mxit"> ออกจากระบบ</a></li><li><a href="account-home.php">หน้าสมาชิก</a></li>'; }else{?>
            <li><a href="login.php">เข้าสู่ระบบ</a></li> <li><a href="signup.php">สมัครสมาชิก</a></li>
            <?php } ?>
           
            <li><a href="<?php $_SERVER['HTTP_HOST']; ?>cart.php" class="btn btn-sm"><i class="fa fa-shopping-cart"></i>ตะกร้าสินค้า [<span style="color: red;"><?php echo count($_SESSION['cart_array']); ?></span>]</a></li>
          </ul>
        </div>
        <!--/.nav-collapse --> 
      </div>
      <!-- /.container-fluid --> 
    </nav>
  </div>
  <!-- /.header -->