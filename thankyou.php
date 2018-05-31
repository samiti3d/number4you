<?php 
session_start();
error_reporting(0); 
ini_set('display_errors','1');
include_once('admin/module/connect.php');
include_once('admin/module/function.php');
include ('admin/module/pmj/lib/thaimailer.php');
?>
<?php include("template_elements/template_header.php");?>  
  <div class="main-container">
    <div class="container">
      <div class="row">
        <div class="col-md-12 page-content">
          <div class="inner-box category-content">
            <div class="row">
              <div class="col-lg-12">
                <div class="alert alert-success pgray  alert-lg" role="alert">
                  <h2 class="no-margin no-padding">&#10004; สำเร็จ! คุณได้สั่งซื้อซิมจากทางเราเรียบร้อยแล้ว</h2>
                </div>
              </div>
            </div>
          </div>
          <!-- /.page-content -->  
        </div>
        <div class="col-md-12 page-content">
          <div class="inner-box category-content">
            <div class="row">
              <div class="col-lg-12 text-center">
              <div class="thumbnail">
              <img src="images/scb.png" alt="โอนเงินผ่านธนาคารไทยพาณิชย์">
              </div>
                  <h3>ใบสั่งซื้อเลขที่<?php echo $_SESSION['corderId']; ?>กรุณาโอนเงินจำนวน <?php echo $_SESSION['ctotal']; ?> ภายใน 9 โมงหลังจากที่ได้กดสั่งซื้อแล้วเข้าที่บัญชี - <br>นายฉัตรปกรณ์ วังโสบัญชีธ.ไทยพาณิชย์0251 <br>สาขาอิตัลไทยทาวเวอร์ (ถนนเพชรบุรีตัดใหม่)# 251-211809-0 </h3>
                  <img widht="200px" hight="auto" src="images/shoppingbag.png" alt="ขอบคุณที่สนใจและสั่งซื้อซิมมงคลที่ numberforyou.net"><br><br>
                  <h3>ทางเราจะทำการจัดส่งสินค้าให้ในไม่ช้า หลังจากที่ท่านแจ้งโอนเงิน มาทางเว็บไซต์เรา >><a href="http://www.numberforyou.net">ที่นี่</a></h3>
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
  
//
<?php include("template_elements/template_footer.php");?>