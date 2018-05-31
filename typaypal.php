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
                  <h2 class="no-margin no-padding">&#10004; ขอบคุณค่ะ คุณได้สั่งซื้อซิมผ่านทาง Paypal จากทางเราเรียบร้อยแล้ว</h2>
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
                    <p>หลังจากสั่งซื้อผ่าน Paypal แล้วกรุณาแจ้งโอนเงินที่ตรงนี้อีกครั้งด้วยค่ะ <a href="http://www.numberforyou.net/index.php#anchor"></a></p>
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