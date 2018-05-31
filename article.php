<?php
session_start();
error_reporting(E_ALL); 
include_once('admin/module/connect.php');
include_once('admin/module/function.php');
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
include ('admin/module/pmj/lib/IMager/imager.php');
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
<?php include("/home/jewelryc/domains/numberforyou.net/public_html/news/news.php"); ?> 
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