<?php 
error_reporting(0); 
session_start();
    include_once('admin/module/connect.php');
    include_once('admin/module/function.php');

$sql = "select * from nfy_sims";
$r = mysql_query($sql);
while ( $sims_items = mysql_fetch_array($r)) {

?>
 <div class="item-list">
<!-- topAds featuredAds urgentAds -->
              <div class="cornerRibbons topAds">
 					 <a href="#">ผลรวม 53</a>
				</div>
                
              <div class="col-xs-12 col-xs-offset-2 col-sm-3 col-sm-offset-1">
                  <div>
                        <font color="#0066ff" style="padding: 0; line-height: 1.5;"> 
                         <?php echo $sims_items['sims_ber'];?>
                        </font>
                </div>
                </div>
                <!--/.add-desc-box-->
                <div class="col-xs-2 col-sm-2 text-right ">
                        <font  style="line-height: 1.5;">
                          AIS
                        </font>
                </div>
                <div class="col-xs-6 col-sm-4 text-right">
                        <font style="line-height: 1.5;">
                          <span class="hidden-xs">ราคา</span> 
                        </font>
                </div>
                <div class="col-xs-4 col-sm-2 text-right ">
                      
                  <a class="btn btn-danger btn-cart btn-sm make-favorite"> <i class="glyphicon glyphicon-shopping-cart"></i> <span>สั่งซื้อ</span> </a> 
                </div>
                <!--/.add-desc-box-->

  </div>

              <!--/.item-list-->

  <?php } ?>

              
 