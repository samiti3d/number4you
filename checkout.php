<?php 
session_start();
error_reporting(0); 
ini_set('display_errors','1');
include_once('admin/module/connect.php');
include_once('admin/module/function.php');
include ('admin/module/pmj/lib/thaimailer.php');
?>
<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 1 Order && Check Out
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
  $cname = trim($_POST["cname"]);
  $clastname = trim($_POST["clastname"]);
  $cber = trim($_POST["cber"]);
  $csex = trim($_POST["csex"]);
  $caddress = trim($_POST["caddress"]);
  $cemail = trim($_POST["cemail"]);
  $corder = $_SESSION['cart_array'];

if (isset($cname, $clastname, $cber, $csex, $caddress, $cemail)) {

  $errors = array();

  if (empty($cname)) {
    $errors[] = "กรุณากรอกชื่อ";  
  }

  if (empty($clastname)) {
    $errors[] = "กรุณากรอกนามสกุล";
  }

  if (empty($cber)) {
    $errors[] = "กรุณากรอกเบอร์โทรศัพท์เพื่อให้ทางเราติดต่อกลับ";
  }

  if (empty($caddress)) {
    $errors[] = "กรุณากรอกที่อยู่เพื่อใช้ในการจัดส่งซิมโทรศัพท์มือถือ";
  }

  if (empty($cemail)) {
    $errors[] = "กรุณากรอกอีเมล";
  }

}

if (isset($_SESSION["cart_array"])) {
  foreach ($_SESSION["cart_array"] as $eachitem) {
    while (list($key, $value) = each($eachitem)) {

      if ($key == "item_id") {

            $orderCorrector[] = $value;

      }
    }
  }
}

$checkOutitems= implode(",", $orderCorrector);

// count order
  $CountName="Order";
  $SelectCount=Select("nfy_count","WHERE CountName='".$CountName."'");
  $Count=mysql_fetch_array($SelectCount);
  $corderId = "Order-".substr("0000000".$Count['Count'],-5);

///

  $ctotal = $_SESSION['total'];
  $cdate = date("Y-m-d");
  $counter = false;

  $insertOrder = Insert('nfy_payer',"'','$corderId','$checkOutitems','$cemail','$cname','$clastname','$csex','$caddress','$cber','1','pending','$cdate','',$ctotal,'ไม่ใช่'");

    if($insertOrder != ""){
      $UpdateCount=Update("nfy_count","Count=Count+1 WHERE CountName='".$CountName."'");
      $To="natchanon236@gmail.com";
      $Subject="รายละเอียดใบสั่งซื้อ เลขที่ $corderId";
      $Message="ท่านสามารถดูรายละเอียด Order ได้ที่นี่ Click";
    }


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 2 Send Email
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////      
     
  $strTo = $caddress;
  $strSubject = "คุณได้สั่งซื้อซิมมงคล - numberforyou.net";
  $strHeader = "From: admin@numberforyou.net";
  $strMessage = "คุณได้กดสั่งซื้อซิมมงคลจากทางเว็บไซต์ Numberforyou.net - Order หมายเลขที่".$corderId." หมายเลขเบอร์โทร".$checkOutitems."รวมราคาทั้งสิ้น ". $ctotal."กรุณาโอนเงินภายใน24 ชั่วโมงหลังการกดสั่งซื้อไม่เช่นนั้นทางเราขอถอนสิทธิ์การสั่งซื้อโดยอัตโนมัติ";
  $flgSend = @mail($strTo,$strSubject,$strMessage,$strHeader);  // @ = No Show Error //
  if($flgSend)
  {
    $sendEmail = "Email Sending.";
        unset($_SESSION["cart_array"]);
        unset($_SESSION["total"]);
        echo "<script language=\"javascript\">";
        echo "alert('ส่งคำสั่งซื้อไปที่อีเมลของท่านแล้ว กรุณาตรวจสอบ');";
        echo "window.location='thankyou.php';";
        echo "</script>"; 
  }
  else
  {
    $sendEmail = "Email Can Not Send.";
  }

    //   if($UpdateCount){
    //     unset($_SESSION["cart_array"]);
    //     echo "<script language=\"javascript\">";
    //     echo "alert('$sendEmail');";
    //     echo "window.location='index.php';";
    //     echo "</script>"; 
    //   }
    // }
?>
<?php include("template_elements/template_header.php");?>  
  <div class="main-container">
    <div class="container">
      <div class="row">
        <div class="col-md-12 page-content">
          <div class="inner-box category-content">
            <div class="row">
              <div class="col-lg-12">
                <?php  if (isset($errors) && !empty($errors)){ ?>
                <div class="alert alert-success pgray  alert-lg" role="alert">
                <?php  echo '<ul><li>', implode('</li><li>', $errors) ,'</li></ul>'; ?>
                </div>
                <?php  }else{ echo $cname; ?>
                <div class="alert alert-success pgray  alert-lg" role="alert">
                  <h2 class="no-margin no-padding">&#10004; สำเร็จ! คุณได้สั่งซื้อซิมจากทางเราเรียบร้อยแล้ว</h2>
                  <p>ทางเราจะทำการจัดส่งสินค้าให้ในไม่ช้า หลังจากที่ท่านแจ้งโอนเงิน มาทางเว็บไซต์เรา >><a href="http:www.numberforyou.net">aที่นี่</a></p>
                </div>
                <?php } ?>

              </div>
            </div>
          </div>
          <!-- /.page-content --> 
          
        </div>
        <!-- /.row --> 
      </div>
      <!-- /.container --> 
    </div>
  </div>
  <!-- /.main-container -->
  
  <div class="footer" id="footer">
    <div class="container">
      <ul class=" pull-left navbar-link footer-nav">
        <li><a href="index.html"> Home </a> <a href="about-us.html"> About us </a> <a href="#"> Terms and Conditions </a> <a href="#"> Privacy Policy </a> <a href="contact.html"> Contact us </a> <a href="faq.html"> FAQ </a>
      </ul>
      <ul class=" pull-right navbar-link footer-nav">
        <li> &copy; 2015 BootClassified </li>
      </ul>
    </div>
    
  </div>
  <!--/.footer--> 
</div>
<?php include("template_elements/template_footer.php");?>