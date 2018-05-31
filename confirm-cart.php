<?php 
session_start();
error_reporting(0); 
ini_set('display_errors','1');
include_once('admin/module/connect.php');
include_once('admin/module/function.php');
?>

<?php 

if (isset($_POST["cname"])) {
  echo $_POST["cname"];
}

if (isset($_SESSION["cart_array"])) {
  // foreach ($_SESSION["cart_array"] as $eachitem) {
  //   while (list($key, $value) = each($eachitem)) {
  //     echo $key . "-" . $value . "<br/>";
  //   }
  // }
  echo "Yahooooooooo";
}

?>

<?php include("template_elements/template_header.php");?>
  
  <div class="main-container">
    <div class="container">
      <div class="row">
        <div class="col-md-8 page-content">
          <div class="inner-box category-content">
            <h2 class="title-2"> <i class="icon-user-add"></i> กรอกข้อมูลเพื่อจัดส่งสินค้า</h2>
            <div class="row">
              <div class="col-sm-12">
                <form class="form-horizontal">
                  <fieldset>
                    
                    <!-- Text input-->
                    <div class="form-group required">
                      <label class="col-md-4 control-label" >ชื่อ <sup>*</sup></label>
                      <div class="col-md-6">
                        <input  name="" placeholder="First Name" class="form-control input-md" required="" type="text">
                      </div>
                    </div>
                    
                    <!-- Text input-->
                    <div class="form-group required">
                      <label class="col-md-4 control-label" >นามสกุล <sup>*</sup></label>
                      <div class="col-md-6">
                        <input  name="textinput" placeholder="Last Name" class="form-control input-md" type="text">
                      </div>
                    </div>
                    
                    <!-- Text input-->
                    <div class="form-group required">
                      <label class="col-md-4 control-label" >เบอร์โทรศํพท์ที่ติดต่อได้ <sup>*</sup></label>
                      <div class="col-md-6">
                        <input  name="textinput" placeholder="Phone Number" class="form-control input-md" type="text">
                      </div>
                    </div>
                    
                    <!-- Multiple Radios -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" >เพศ</label>
                      <div class="col-md-6">
                        <div class="radio">
                          <label for="Gender-0">
                            <input name="Gender" id="Gender-0" value="1" checked="checked" type="radio">
                            ชาย </label>
                        </div>
                        <div class="radio">
                          <label for="Gender-1">
                            <input name="Gender" id="Gender-1" value="2" type="radio">
                            หญิง</label>
                        </div>
                      </div>
                    </div>
                    
                    <!-- Textarea -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textarea">ที่อยู่สำหรับจัดส่งสินค้า</label>
                      <div class="col-md-6">
                        <textarea class="form-control" id="textarea" name="textarea"></textarea>
                      </div>
                    </div>
                    <div class="form-group required">
                      <label for="inputEmail3" class="col-md-4 control-label">อีเมล <sup>*</sup></label>
                      <div class="col-md-6">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group">
                      <label  class="col-md-4 control-label"></label>
                      <div class="col-md-8">

                        <div style="clear:both"></div>
                        <a class="btn btn-primary" href="account-home.html">สั่งซื้อ</a> </div>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>

					<!-- close formgroup -->

        <!-- /.page-content -->
        
        <div class="col-md-3 reg-sidebar">
          <div class="reg-sidebar-inner text-center">
            <div class="promo-text-box"><img src="images/ซิมมงคล.png" width="100%" alt="ซิมมงคลเสริโชคลาภผู้ใช้">
              <h3><strong>จำหน่ายซิมมงคล</strong></h3>
              <p>เบอร์โทรศัพท์เป็นพลังตัวเลข ที่มีกระแสส่งผลต่อผู้ใช้ เนื่องจากเกี่ยวโยงกับชีวิตประจำวันของเรา ดังนั้นการเลือกเบอร์ที่ผู้ต้องตามชะตา จะส่งผลให้ชีวิตมีกระแสไปในทางที่ดีขึ้น</p>
            </div>
            
            <div class="panel sidebar-panel">
              <div class="panel-heading uppercase"><small><strong>สั่งซื้อย่างไร?</strong></small></div>
              <div class="panel-content">
                <div class="panel-body text-left">
                  <ul class="list-check">
                    <li> เลือกเบอร์ที่ชอบ และกดตะกร้าสินค้าไอคอนสีแดงที่หน้าแรก  </li>
                    <li> แสดงรายการสั่งซื้อของคุณ</li>
                    <li> กดสั่งซื้อ และกรอกข้อมูลจัดส่ง</li>
                    <li> โอนเงินและแจ้งการโอนเงินที่เว็บไซต์เรา</li>
                    <li> ทำการจัดส่ง ฟรี EMS ส่งเร็วทันใจ</li>

                  </ul>
                </div>
              </div>
            </div>
            
            
          </div>
        </div><!--/.reg-sidebar-->
      </div>
      <!-- /.row --> 
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.main-container -->
  
<?php include("template_elements/template_footer.php");?>