<?php
session_start();
error_reporting(E_ALL); 
include_once('admin/module/connect.php');
include_once('admin/module/function.php');
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
include "admin/module/pmj/lib/IMager/imager.php";
include ('admin/module/pmj/lib/pagination.php');
  
  // $sql = "SELECT * FROM nfy_article ORDER BY article_id DESC LIMIT 6";
?>
<?php
if ($_POST) {

  $strTo = "admin@jewelry236.com";
  $strSubject = $_POST['subject'];
  $strHeader = "From:". $_POST['from'];
  $strMessage = $_POST['body'];
  $flgSend = mail($strTo,$strSubject,$strMessage,$strHeader);
  if($flgSend)
  {
    echo "ส่งเรียบร้อย";
  }
  else
  {
    echo "ส่งจดหมายผิดพลาด";
  }
}
?>


<?php include("template_elements/template_header.php");?>

<!-- ตรวจการพิมพ์เฉพาะตัวเลข -->
<script>document.querySelector("#ber").addEventListener("keypress", function (evt) {
    if (evt.which < 48 || evt.which > 57)
    {
        evt.preventDefault();
    }
});</script>

  <div class="intro">
    <div class="dtable hw100">
      <div class="dtable-cell hw100">
        <div class="container text-center">
       <h1 class="intro-title animated fadeInDown"> ทำนายเบอร์โทรศัพท์  </h1>
<p class="sub animateme fittext3 animated fadeIn"> +ตรวจสอบชีวิตผ่านเบอร์มือถือ ได้รับการรรับรองโดยซินแสซ่งฟูไห่ </p>
          
          <div class="row search-row animated fadeInUp"> 
          <form action="predict.php" method="get"> 
              
                <div class="col-lg-9 col-sm-6">
              
                <input type="text" name="ber" id="ber"  class="form-control" size="8" value="" placeholder="0XXXXXXXXX" maxlength="10" style="font-size: 24px; letter-spacing: 24px;">

              </div>


              <div class="col-lg-3 col-sm-3 search-col">
                <input type="submit" value="ทำนายผลเบอร์โทรศัพท์" class="btn btn-primary btn-search btn-block" id="check_ber">
              </div>

            </form>
            </div>
          
        </div>
      </div>
    </div>
  </div>
  <!-- /.intro -->
  <!-- /.search-row -->
  <div class="main-container">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 page-sidebar">
          <aside>
            <div class="inner-box">
              <div class="categories-list  list-filter">
                <h5 class="list-title"><strong><a href="#">หมวดหมู่เบอร์มงคล</a></strong></h5>
                <ul class=" list-unstyled">
                  <?php showCatBer(); ?>
                </ul>
              </div>
              <!--/.categories-list-->
              
              <div class="locations-list  list-filter">
                <h5 class="list-title"><strong><a href="#">ตรวจสอบไปรษณีย์</a></strong></h5>
                <ul class="browse-list list-unstyled long-list">
                  <img width="100%" src="images/ems.jpg">
                </ul>
              </div>
              <!--/.locations-list-->
              
              <div class="locations-list  list-filter">
                <h5 class="list-title"><strong><a href="#">ผู้สนับสนุน</a></strong></h5>
                <ul class="browse-list list-unstyled long-list">
                  <li> <a href="sub-category-sub-location.html"><strong>ทั้งหมด</strong> <span class="count">228,705</span></a></li>
                  <li> <a href="sub-category-sub-location.html">Business <span class="count">28,705</span></a></li>
                  <li> <a href="sub-category-sub-location.html">Personal <span class="count">18,705</span></a></li>
                </ul>
              </div>
              <!--/.list-filter-->
              <div class="locations-list  list-filter">
                <h5 class="list-title"><strong><a href="#">เงื่อนไขการใช้งาน</a></strong></h5>
                <ul class="browse-list list-unstyled long-list">
                  <li> <a href="sub-category-sub-location.html">New <span class="count">228,705</span></a></li>
                  <li> <a href="sub-category-sub-location.html">Used <span class="count">28,705</span></a></li>
                  <li> <a href="sub-category-sub-location.html">None </a></li>
                </ul>
              </div>
              <!--/.list-filter-->
              <div style="clear:both"></div>
            </div>
            
            <!--/.categories-list--> 
          </aside>
        </div>
        <!--/.page-side-bar-->
        <div class="col-sm-9 page-content col-thin-left">
          <div class="category-list">

            <!--/.tab-box-->
            
            <div class="#">
                <div class="breadcrumb-list">
                  <div class="item-list">
                    <div class="col-md-2">เบอร์เด่น</div>
                    <div class="col-md-2">หมายเลข</div>
                    <div class="col-md-2 col-md-offset-1" style="margin-right: 0.5em; margin-left: 1.5em;">เครือข่าย</div>
                    <div class="col-md-2">ผลรวม</div>
                    <div class="col-md-1">ราคา</div>
                    <div class="col-md-1 col-md-push-1">คำสั่ง</div>
                  </div>
                </div>
            </div>
            <div style="clear:both"></div>
            </div>
            <!--/.listing-filter-->
            
            <div class="adds-wrapper">
              <div class="tab-content">
                <div class="tab-pane active" id="allAds">
                <?php 

                $link = @mysqli_connect("localhost", "root", "root", "nfy_db")
                or die(mysqli_connect_error());

                  $catid = $_GET['cid'];
  
                  $sql = "SELECT * FROM nfy_sims WHERE sims_cat = $catid";
                  $r = page_query($link, $sql, 8);
                    while ( $sims_items = mysqli_fetch_array($r)) {
                      if($sims_items['sims_show'] ==1){

                        $ber = $sims_items['sims_ber'];
                        $provider = $sims_items['sims_provider'];
                        $price = number_format($sims_items['sims_price']);
                        $pid = $sims_items['sims_id'];
                        $bertotal = $sims_items['sims_total']

                ?>
              <div class="item-list">
              <!-- topAds featuredAds urgentAds -->
              <div class="cornerRibbons topAds col-xs-4">
               <a href="#">ผลรวม <?php echo $bertotal;?></a>
              </div>
                
              <div class="col-xs-6 col-xs-offset-1 col-md-3 col-sm-offset-1">
                  <div>
                        <!-- <font color="#0066ff" style="padding: 0; line-height: 1.5;">  -->
                         <a href="predict.php?ber=<?php echo $ber; ?>&id=<?php echo $pid; ?>"><?php echo $ber;?></a>
                        <!-- </font> -->
                </div>
                </div>
                <!--/.add-desc-box-->
                <div class="col-xs-6 col-md-2 text-center">
                        <!-- <font  style="line-height: 1.5;"> -->
                          <?php echo $provider; ?>
                        <!-- </font> -->
                </div>
                <div class="col-xs-6 col-md-2 text-center hidden-xs">
                        <!-- <font  style="line-height: 1.5;"> -->
                          <?php echo $bertotal; ?>
                        <!-- </font> -->
                </div>
                <div class="col-xs-6 col-md-2 text-center">
                        <!-- <font style="line-height: 1.5;"> -->
                          <span class="price"><?php echo $price; ?> <br><span style="font-size: 15px;">(บาท)</span></span> 
                        <!-- </font> -->
                </div>
                <div class="col-xs-6 col-md-2 text-right ">
                    <!-- <form method="POST" action="cart.php"> -->
                      <a href="cart.php?cartid=<?php echo $pid; ?>" class="btn btn-danger btn-cart btn-sm"> <i class="glyphicon glyphicon-shopping-cart"></i> <span>สั่งซื้อ</span> </a> 
                   <!-- </form> -->
                </div>
                <!--/.add-desc-box-->

              </div>

              <!--/.item-list-->

                <?php } } ?>

                </div>
                <div class="tab-pane" id="businessAds"></div>
                <div class="tab-pane" id="personalAds"></div>
                <div class="tab-pane" id="aisAds"></div>

              </div>
            </div>
            <!--/.adds-wrapper-->
            
<!--             <div class="tab-box  save-search-bar text-center"> <a href=""> <i class=" icon-star-empty"></i> Save Search </a> </div>
 -->          </div>
          <div class="pagination-bar text-center">
            <ul class="pagination">         
                <?php page_echo_pagenums(6); ?>
            </ul>
          </div>
          <!--/.pagination-bar -->
          
          <!--/.post-promo--> 
        </div>
        <!--/.page-content-->   
      </div>
    </div>


    <div class="bs-example">
      <div class="container ">
        <div class="row">
        <!-- /.add articles -->

        </div>
      </div>     
    </div>
<div style="clear:both">

</div>
  <!-- /.main-container -->
  
  <div class="page-info" style="background: url(images/bg.jpg); background-size:cover">
    <div class="container text-center section-promo"> 
      <div class="row">
          <div class="col-sm-3 col-xs-6 col-xxs-12">
                <div class="iconbox-wrap">
                          <div class="iconbox">
                            <div class="iconbox-wrap-icon">
                            <i class="icon  icon-group"></i>
                            </div>
                            <div class="iconbox-wrap-content">
                              <h5><span>2200</span> </h5>
                              <div  class="iconbox-wrap-text">ซิมที่มีราคาหลากหลาย</div>
                            </div>
                          </div>
                <!-- /..iconbox -->
                     </div><!--/.iconbox-wrap-->
            </div>
            
            <div class="col-sm-3 col-xs-6 col-xxs-12">
              <div class="iconbox-wrap">
                          <div class="iconbox">
                            <div class="iconbox-wrap-icon">
                            <i class="icon  icon-th-large-1"></i>
                            </div>
                            <div class="iconbox-wrap-content">
                              <h5><span>100</span> </h5>
                              <div  class="iconbox-wrap-text">หมวดหมู่ที่มากมาย</div>
                            </div>
                          </div>
                <!-- /..iconbox -->
                     </div><!--/.iconbox-wrap-->
            </div>
            
            <div class="col-sm-3 col-xs-6  col-xxs-12">
              <div class="iconbox-wrap">
                          <div class="iconbox">
                            <div class="iconbox-wrap-icon">
                            <i class="icon  icon-map"></i>
                            </div>
                            <div class="iconbox-wrap-content">
                              <h5><span>700</span> </h5>
                              <div  class="iconbox-wrap-text">จัดส่งซิมทั่วประเทศ</div>
                            </div>
                          </div>
                <!-- /..iconbox -->
                     </div><!--/.iconbox-wrap-->
            </div>
            
            <div class="col-sm-3 col-xs-6 col-xxs-12">
              <div class="iconbox-wrap">
                          <div class="iconbox">
                            <div class="iconbox-wrap-icon">
                            <i class="icon icon-facebook"></i>
                            </div>
                            <div class="iconbox-wrap-content">
                              <h5><span>50,000</span> </h5>
                              <div  class="iconbox-wrap-text">ให้การสนับสนุนรวดเร็ว</div>
                            </div>
                          </div>
                <!-- /..iconbox -->
                     </div><!--/.iconbox-wrap-->
            </div>
            
        </div>
    
    </div>
  </div>
  <!-- /.page-info -->
  <div class="container">
  <div class="row">
    <div class="col-xs-12 col-lg-12 col-md-12 action">
      <center>
          <h2 class="orange"><strong><i>เบอร์เปิดดวงรับโชคเป็น <span class="purple">สุดยอด</span> เบอร์มงคลที่คัดสรรคโดยซินแสซ่งฟูไห่</i></strong><br />
          หากอยากรับข่าวสารที่ช่วยให้ท่านชีวิตดีขึ้น แบบรับประกัน กดรับสมัครข่าวสารดีๆ ได้เลย</h2>
          <form class="form-inline" role="form">
            <div class="form-group">
              <label class="sr-only" for="exampleInputEmail2">อีเมล</label>
              <input type="email" class="form-control" id="exampleInputEmail2" placeholder="กรอกอีเมล">
            </div>
            <div class="form-group">
              <label class="sr-only" for="exampleInputPassword2">ชื่อ</label>
              <input type="password" class="form-control" id="exampleInputPassword2" placeholder="ชื่อ">
            </div>
            <a class="btn btn-success btn-xs" href="">
            <i class="glyphicon glyphicon-envelope"></i> สมัครรับข่าวสาร</a>
          </form>
        </center>
      </div>
  </div>
</div>
<div class="jumbotron jumbotron-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h1 class="h1">
                    แจ้งโอนเงิน<small> - เลือกโอนเงิน หรือรายการที่ท่านต้อการส่งถึงเรา</small></h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="well well-sm">
                <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                ชื่อ</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="email">
                                อีเมล</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email" name="from" class="form-control" id="email" placeholder="Enter email" required="required" /></div>
                        </div>
                        <div class="form-group">
                            <label for="subject">
                                หัวเรื่อง</label>
                            <select id="subject" name="subject" class="form-control" required="required">
                                <option value="na" selected="">เลือกหัวข้อส่งจดหมาย:</option>
                                <option value="payment">แจ้งยอดชำระ</option>
                                <option value="problem">แจ้งปัญหา</option>
                                <option value="info">สอบถามข้อมูล</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                ข้อความ</label>
                            <textarea name="message" id="message" class="form-control" name="body" rows="9" cols="25" required="required"
                                placeholder="Message"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">
                            ส่งข้อความ</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <form>
            <legend><span class="glyphicon glyphicon-globe"></span> ติดต่อที่สำนักงาน</legend>
            <address>
                <strong>บ้านซินแส</strong><br>
                1104/216 ซอย 5<br>
                หมู่บ้านโนเบิลคิวบ์ ถนนพัฒนาการ สวนหลวง<br>
                <abbr title="Phone">
                    P:</abbr>
                (+66) 089-8241556
            </address>
            <address>
                <strong>NumberForYou.net</strong><br>
               admin(โหน่ง): <a href="mailto:#">admin@numberforyou.net</a>
            </address>
            </form>
        </div>
    </div>
</div>

  
  <div class="page-bottom-info">
      <div class="page-bottom-info-inner">
      
        <div class="page-bottom-info-content text-center">
<h4></h4>
            <a class="btn  btn-lg btn-primary-dark" href="tel:+0838592495">
            <i class="icon-mobile"></i> <span class="hide-xs color50">โทรด่วน:</span> (+66) 0838592495   </a>
      </div>
  </div>
<?php mysql_close($Connect); ?>

<?php include("template_elements/template_footer.php");?>