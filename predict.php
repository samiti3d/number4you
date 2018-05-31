<?  
session_start();
error_reporting(0); 
include_once('admin/module/connect.php');
include_once('admin/module/function.php');
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>

<?php 

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 1 reciev form and check it
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$br = trim($_GET['ber']);
$lbr = trim($_GET['ber']);
$card = false;

if ($br == "" && $lber =="") {
	echo '<meta charset="utf-8">';
    echo "<script language=\"javascript\">";
    echo "alert('กรุณากรอกเบอร์ที่ต้องการทำนาย ไม่ใใช่กรอกค่าว่าง');";
    echo "window.location='index.php';";
    echo "</script>";
    exit();
}

if ($br < 10) {
	
	$error[] = "ค่าน้อยกว่า 10 กรุณาไปกรอกมาใหม่";

}

if (!is_numeric($br)) {
	
	$error[] = "เป็นข้อความ หรืออักขระปนเข้ามา";
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 2 vars to array
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if (isset($br) && $br != "" && empty($error)) {

	$i = 1; 
	$abr = str_split($br); //ใส่ตัวเลขเป็นอาเรย์

		for ($i=0; $i <= 8 ; $i++) { 
	
			$arraybr[] = array_splice($abr, $i, 2); //ตัดตัวเลขคือ คู่คำทำนายลงในอาเรย์ ใ่ที่ arraybr[]
			$abr = $lbr; // ปรับเป็นค่าปกติหลังจาก array_splice
			$abr = str_split($abr); //ใส่ตัวเลขเป็นอาเรย์

		}

}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 3 array to text & filter repeat variables.
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
for ($i=3; $i <= 8 ; $i++) { 

    $itest[] = implode("", $arraybr[$i]); //คู่ตัวเลขที่เราอยากแสดงผลคำทำนาย
    $predict = array_unique($itest);


}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 4 write to database and render page...
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$c = count($predict) -1;

// echo "<pre>";
// print_r($predict);
// echo $c;
// echo "</pre>";


for ($i=0; $i < $c; $i++) { 

	$sql = "SELECT * FROM nfy_tamnai_english WHERE tamnai_ber = $predict[$i]";
	$r = mysql_query($sql);

	if ($row = mysql_fetch_array($r)) {

		$luckOutput .= $row['tamnai_text'];
		$luckOutput .= "<br></br>";

	}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 5 var price, info
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_GET['id']) && $_GET['id'] != "") {
  $card = true;
  $pid = trim($_GET['id']);
  $r = Select('nfy_sims',"WHERE sims_id = $pid");
  while ($a = mysql_fetch_array($r)) {
    $aprice = number_format($a['sims_price']) . " บาท";
    $aprovider = $a['sims_provider'];
  }
}

?>
<?php include("template_elements/template_header.php");?>
  
    <!--/.about-intro --> 

  <!-- /.intro-inner -->
  
  <div class="main-container inner-page">
    <div class="container">
      <div class="row">
        <div class="col-sm-9 page-content col-thin-right">
          <div class="inner inner-box ">
            <h1 class="text-center title-1" style="padding-top: 30px;"> คำทำนายเบอร์ <?php echo $lbr; ?> </h1>
            <hr class="center-block small text-hr">
			        <?php echo $luckOutput; ?>
          <hr />
  <div class="media">
        <a href="#" class="pull-left">
            <img src="images/tiny.png" class="media-object" alt="Sample Image">
        </a>
        <div class="media-body">
            <h4 class="media-heading">ซินแสซ่งฟู่ไห่ <small><i>ตรวจฮวงซะตา แก้อาภรรพ์ เสริมฮวงจุ้ย</i></small></h4>
            <p>ท่านใดต้องการดูดวงตัวเลขเบอร์โทรศัพท์ หรืออยากใดตัวเลขที่สอดคล้องกับชีวิต สามารถโทรมารับคำปรึกษาเป้นการส่วนตัวได้</p>
        </div>
    </div>
    <hr />
          </div>
        </div>

        <div class="col-sm-3  page-sidebar-right">
          <aside>
          <?php if ($card == "true"):  ?>
            <div class="panel sidebar-panel panel-contact-seller">
              <div class="panel-heading">ข้อมูลเบอร์มงคล</div>
              <div class="panel-content user-info">
                <div class="panel-body text-center">
                  <div class="seller-info">

                  </div>
                  <div class="user-ads-action"><span>ราคา: <?php echo $aprice; ?></span><br><br><span>เครือข่าย: <?php echo $aprovider; ?></span><br><br><a class="btn btn-primary" href="cart.php?cartid=<?php echo $pid; ?>"><i class="glyphicon glyphicon-shopping-cart"> </i>สั่งซื้อ</a></div>
                </div>
              </div>
            </div>
          <?php endif; ?>
            <div class="panel sidebar-panel">
              <div class="panel-heading">ว่าด้วยเรื่องหมายเลขมงคล</div>
              <div class="panel-content">
                <div class="panel-body text-left">
                  <ul class="list-check">
                    <li>หมายเลขมงคลที่ไม่ได้ดูแค่ผลรวมเพียงอย่างเดียว แต่ดูเป็นคู่ตัวเลข</li>
                    <li>เบอร์มงคลเหล่านี้ช่วยเสริมบารมีและหน้าที่การงานได้ เพราะอิทธิพลของตัวเองส่งผลให้เกิดโชคลาภต่างๆ</li>
                    <li>หลังจากซื้อแล้วท่านสามารถ ทำตามคำแนะนำขั้นตอนเปลี่ยนเบอร์ได้ที่ลิงค์ด้านล่าง</li>
                  </ul>
                  <p><a class="pull-right" href="#">คำแนะนำสำหรับผู้ที่เปลี่ยนเบอร์มือถือใหม่<i class="fa fa-angle-double-right"></i> </a></p>
                </div>
              </div>
            </div>
            <!--/.categories-list--> 
          </aside>
        </div>
        <!--/.page-side-bar--> 
      </div> 
      <!-- /.row -->
    </div>
  </div>
  <!-- /.main-container -->
  
<?php include("template_elements/template_footer.php");?>



