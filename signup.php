<?php
session_start();
error_reporting(E_ALL); 
include_once('admin/module/connect.php');
include_once('admin/module/function.php');

if (isset($_POST["m_name"], $_POST["m_last"], $_POST["m_tel"])) {
  $mactive = 0;
  $mname = trim($_POST['m_name']);
  $mlast = trim($_POST['m_last']);
  $mgen = trim($_POST['m_gen']);
  $memail = $_POST['m_email'];
  $mtel = trim($_POST['m_tel']);
  $musername = $_POST['m_username'];
  $mpassword = trim($_POST['m_password']);
  $maddress = trim($_POST['m_address']);

  $error = array();


  if (strlen($mname) > 20) {
   $error[] =  "ชื่อคุณยาวไป";
  }
  if (empty($mlast)) {
  $error[] = "คุณไม่ได้ตั้งนามสกุล";
  }
  if (empty($mgen)) {
  $error[] = "คุณจงใจ Hack เว็บเรา!!";
  }
  if (strlen($mtel) > 10) {
  $error[] = "คุณกรอกเบอร์โทรเกิน 10 ตัว";
  }
  if (empty($memail)) {
    $error[] = "อีเมลไม่ได้กรอก";
  }
  if (empty($maddress)) {
    $error[] = "ไม่ได้กรอกที่อยู่";
  }

  if (empty($memail)) {
    $error[] = "คุณไม่ได้กรอก username";
  }

  if (isset($memail)) {
  $sql_one = "SELECT * FROM nfy_member WHERE m_email = '$memail'";
  $r_one = mysql_query($sql_one);
  $Num_Rows_One = mysql_num_rows($r_one);
    if ($Num_Rows_One > 1) {
      $error[] = "Email - ซ้ำ";
    }
  }


  $sql = "SELECT * FROM nfy_member WHERE m_username = '$musername'";
  $r = mysql_query($sql);
  $Num_Rows = mysql_num_rows($r);
  if ($Num_Rows > 1) {
    $error[] = "Username - ซ้ำ";
  }

if(empty($error)){
  $mactive = 1;
  $Insert =  Insert('nfy_member', "0,'$mname','$mlast','$maddress','$musername','$mpassword','$memail','$mtel','$mabout','',NOW(),'$mactive'");
        echo "<script language=\"javascript\">";
        echo "alert('You registed!');";
        echo "window.location='index.php';";
        echo "</script>";
        exit();
}
}
?>
<?php include("template_elements/template_header.php");?> 
  <div class="main-container">
    <div class="container">
      <div class="row">

        <div class="col-md-8 page-content">
          <div class="inner-box category-content">
            <?php  if (isset($error) && !empty($error)) {
              echo '<div class="alert alert-warning">';
              echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
              echo '<ul><li>', implode('</li><li>', $error) ,'</li></ul>';
              echo '</div>';
            }?>

            <h2 class="title-2"> <i class="icon-user-add"></i> สร้างบัญชีสมาชิกกับเรา ฟรี! </h2>
            <div class="row">
              <div class="col-sm-12">
                <form class="form-horizontal" method="post">
                  <fieldset>
                  
                    <!-- Text input-->
                    <div class="form-group required">
                      <label class="col-md-4 control-label" >ชื่อ <sup>*</sup></label>
                      <div class="col-md-6">
                        <input  name="m_name" placeholder="First Name" class="form-control input-md" required="" type="text">
                      </div>
                    </div>
                    
                    <!-- Text input-->
                    <div class="form-group required">
                      <label class="col-md-4 control-label" >นามสกุล <sup>*</sup></label>
                      <div class="col-md-6">
                        <input  name="m_last" placeholder="Last Name" class="form-control input-md" type="text">
                      </div>
                    </div>
                    
                    <!-- Text input-->
                    <div class="form-group required">
                      <label class="col-md-4 control-label" >เบอร์โทรศัพท์ <sup>*</sup></label>
                      <div class="col-md-6">
                        <input  name="m_tel" placeholder="Phone Number" class="form-control input-md" type="text">
                        <div class="checkbox">
                        </div>
                      </div>
                    </div>
                    
                    <!-- Multiple Radios -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" >เพศ</label>
                      <div class="col-md-6">
                        <div class="radio">
                          <label for="Gender-0">
                            <input name="m_gen" id="Gender-0" value="1" checked="checked" type="radio">
                            ชาย </label>
                        </div>
                        <div class="radio">
                          <label for="Gender-1">
                            <input name="m_gen" id="Gender-1" value="2" type="radio">
                            หญิง </label>
                        </div>
                      </div>
                    </div>
                    
                    <!-- Textarea -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textarea">บอกเรื่องราวของตัวท่านสั้นๆ </label>
                      <div class="col-md-6">
                        <textarea class="form-control" id="textarea" name="m_address" placeholder="กรอกที่อยู่จัดส่งซิม"></textarea>
                      </div>
                    </div>
                    <div class="form-group required">
                      <label for="inputEmail3" class="col-md-4 control-label">อีเมล<sup>*</sup></label>
                      <div class="col-md-6">
                        <input type="text" name="m_email" class="form-control" id="inputEmail3" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group required">
                      <label for="inputPassword3" class="col-md-4 control-label">ตั้ง Username </label>
                      <div class="col-md-6">
                        <input type="text" name="m_username" class="form-control" id="inputPassword3" placeholder="Username">
                        <p class="help-block">Username ใช้สำหรับ login เข้าสู่ระบบ <!--Example block-level help text here.--></p>
                      </div>
                    <div class="form-group required">
                      <label for="inputPassword3" class="col-md-4 control-label">ตั้ง Password </label>
                      <div class="col-md-6">
                        <input type="text" name="m_password" class="form-control" id="inputPassword3" placeholder="Password">
                        <p class="help-block">อย่างน้อยห้าตัวอักษร <!--Example block-level help text here.--></p>
                      </div>
                    </div>
                    <div class="form-group">
                      <label  class="col-md-4 control-label"></label>
                      <div class="col-md-8">

                        <div style="clear:both"></div>
                        <input type="submit" name="submit" value="สมัครสมาชิก" class="btn btn-primary" />
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /.page-content -->
        
        <div class="col-md-4 reg-sidebar">
          <div class="reg-sidebar-inner text-center">
            <div class="promo-text-box"> <i class=" icon-picture fa fa-4x icon-color-1"></i>
              <h3><strong>ตรวจเช็คการสั่งซื้อผ่านระบบสมาชิก</strong></h3>
              <p>ตรวจการสั่งซื้อผ่านระบบสมาชิกได้ทันที </p>
            </div>
            <div class="promo-text-box"> <i class=" icon-pencil-circled fa fa-4x icon-color-2"></i>
              <h3><strong>ได้รับโปรโมชั่นในเทศกาล</strong></h3>
              <p> เทศกาลประจำปี เราจะมีโปรโมชั่นลดราคาพิเศษ สำหรับสมาชิก</p>
            </div>
            <div class="promo-text-box"> <i class="  icon-heart-2 fa fa-4x icon-color-3"></i>
              <h3><strong>รับคำปรึกษาเปลี่ยนเบอร์ผ่านซินแสโดยตรง</strong></h3>
              <p>หากท่านสงสัยวิธีการเปลี่ยนเบอร์ หรือต้องการคนแนะนำให้ถูกวิธี ซินแสซ่งฟู่ไห่จะสนับสนุนท่าน</p>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row --> 
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.main-container -->
  
<?php include("template_elements/template_footer.php");?>  

