<?php
session_start();
error_reporting(E_ALL); 
include_once('admin/module/connect.php');
include_once('admin/module/function.php');
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
include ('admin/module/pmj/lib/IMager/imager.php');

$article_id = $_GET['id'];
    
  $sql = "SELECT * FROM nfy_article WHERE article_id = {$article_id}";
  $r = mysql_query($sql);
  while($a = mysql_fetch_array($r)) {
    $image_id =  $a['image_id'];
    $topic = $a['topic'];
    $write = $a['writer'];
    $date_post = thai_date($a['date_post']);
    $article_text = $a['article_text'];
    // $views = $a['views'] + 1;

    $src = "images/cover-image.jpg";

    if($a['image_id'] != 0) {
      $src = "read-image.php?id=$image_id";
    }

    $articleOutput .= '<div class="img-container"><img src="'.$src.'" class="cover"></div>';
    $articleOutput .= '<div class="topic"><h2>'. $topic . '</h2></div>';
    $articleOutput .= '<div class="above">ผู้เขียน: '. $a['writer'] . '<span> ' . $date_post . '</span></div>';
    $articleOutput .= '<div class="article">'. $article_text . '</div>';
    $articleOutput .= '<div class="below">';
  }

  function thai_date($datetime, $include_time=false) {
  $dt = explode(" ", $datetime);
  $d = explode("-", $dt[0]);
  $th_months = array(1=>"มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", 
                  "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
  
  $date = ltrim($d[2], "0");  //ตัดเลข 0 ข้างหน้าออก
  $month = ltrim($d[1], "0");
  $t = "";
  if($include_time) {
    $t = $dt[1];
  }
  return $date . "  " . $th_months[$month] . "  " . ($d[0] + 543). "  " . $t;
}

?>
<?php include("template_elements/template_header.php");?>
  
    <!--/.about-intro --> 

  <!-- /.intro-inner -->
  
  <div class="main-container inner-page">
    <div class="container">
      <div class="row clearfix">
        <h1 class="text-center title-1"> Page Title </h1>
        <hr class="center-block small text-hr">
        <div class="col-lg-12 text-center">
          <div>
            <?php echo $articleOutput; ?>
          </div>
        </div>
        <div style="clear:both">
          <hr>
        </div>
      </div>
    </div>
  </div>
  <!-- /.main-container -->
  
<?php include("template_elements/template_footer.php");?>