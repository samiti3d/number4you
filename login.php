<?php 
session_start();
error_reporting(E_ALL); 
include_once('admin/module/connect.php');
include_once('admin/module/function.php');
?>
<?php include("template_elements/template_header.php");?> 
  <div class="main-container">
    <div class="container">
      <div class="row">
      <?php  echo $sql; ?>
        <div class="col-sm-5 login-box">
          <div class="panel panel-default">
            <div class="panel-intro text-center">
              <h2 class="logo-title"> 
                <!-- Original Logo will be placed here  --> 
                <span class="logo-icon"><i class="icon icon-search-1 ln-shadow-logo shape-0"></i> </span>เข้าสู่ระบบสมาชิก<span>NumberForYou.Net </span> </h2>
            </div>
                        <?php  if (isset($errors) && !empty($errors)) {
              echo '<div class="alert alert-warning">';
              echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
              echo '<ul><li>', implode('</li><li>', $errors) ,'</li></ul>';
              echo '</div>';
            }?>
            <div class="panel-body">
              <form role="form" method="post" action="checklg.php">
                <div class="form-group">
                  <label for="sender-email" class="control-label">Username:</label>
                  <div class="input-icon"> <i class="icon-user fa"></i>
                    <input  type="text"  name ="usernamex" placeholder="Username" class="form-control email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="user-pass"  class="control-label">Password:</label>
                  <div class="input-icon"> <i class="icon-lock fa"></i>
                    <input type="password"  class="form-control" name="passwordx" placeholder="Password">
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Login</button>
                </div>
              </form>
            </div>
            <div class="panel-footer">
              <div style=" clear:both"></div>
            </div>
          </div>
          <div class="login-box-btm text-center">
            <p> ยังไม่มีบัญชีใช่หรือไม่? <br>
              <a href="signup.php"><strong>กดสมัครได้ที่นี่ ! </strong> </a> </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.main-container -->
<?php include("template_elements/template_footer.php");?> 
