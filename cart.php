<?php 
ob_start();
session_start();
error_reporting(0); 
ini_set('display_errors','1');
include_once('admin/module/connect.php');
include_once('admin/module/function.php');
?>
<?php 

if ($x = $_GET['exit']) {
 switch ($x) {
   case 'mxit':
    session_destroy();
      echo "<script language=\"javascript\">";
      echo "alert('คุณออกจากระบบแล้ว!')";
      echo "window.location='index.php';";
      echo "</script>";
    break;
   
   default:
     echo "ผิดพลาดบางอย่าง!";
     break;
 }
} 
?>
<?php 
// print_r($_SESSION['cart_array']);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 1 (if user attempts to add something to the cart from the product page)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['cartid'])) {
    $pid = $_GET['cartid'];
	  $wasFound = false;
	  $i = 0;
	// If the cart session variable is not set or cart array is empty
	if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) { 
	    // RUN IF THE CART IS EMPTY OR NOT SET
		$_SESSION["cart_array"] = array(0 => array("item_id" => $pid, "quantity" => 1));
	} else {
		// RUN IF THE CART HAS AT LEAST ONE ITEM IN IT
		foreach ($_SESSION["cart_array"] as $each_item) { 
		      $i++;
		      while (list($key, $value) = each($each_item)) {
				  if ($key == "item_id" && $value == $pid) {
					  // That item is in cart already so let's adjust its quantity using array_splice()
					  array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $pid, "quantity" => 1)));
					  $wasFound = true;
				  } // close if condition
		      } // close while loop
	       } // close foreach loop
		   if ($wasFound == false) {

			   array_push($_SESSION["cart_array"], array("item_id" => $pid, "quantity" => 1));
		   }
	}
        echo "<script language=\"javascript\">";
        // echo "alert('Complete!');";
        echo "window.location='cart.php';";
        echo "</script>";
        exit();
}
?>
<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 2 (if user chooses to empty their shopping cart)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_GET['cmd']) && $_GET['cmd'] == "emptycart") {

    unset($_SESSION["cart_array"]);
}
?>
<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 3 (if user wants to remove an item from cart)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_GET['index_to_remove']) && $_GET['index_to_remove'] != "") {
    // Access the array and run code to remove that array index
 	$key_to_remove = $_GET['index_to_remove'];
 	$cartArray = count($_SESSION["cart_array"]);
	if ($cartArray <= 1) {

    unset($_SESSION["cart_array"]);
        echo "<script language=\"javascript\">";
        echo "window.location='cart.php';";
        echo "</script>";
        exit();

	} else {
		unset($_SESSION["cart_array"]["$key_to_remove"]);
		sort($_SESSION["cart_array"]);
        echo "<script language=\"javascript\">";
        echo "window.location='cart.php';";
        echo "</script>";
        exit();
	}
}
?>
<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 4 render the user to view the cart
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$cartOutput = '';
$cartTotal = '';
$pp_checkout_btn = '';
$product_id_array = '';

if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {

	 $cartOutput .= '<tr><td><h4>สถานะ: ตะกร้าสินค้าว่าง..</h4></td></tr>';
   $cartOutput .= '<tr><td><img src="images/shopping_cart.jpg"></td></tr>';
   $cartOutput .= '</tbody></table>';

	
}else{

  $pp_checkout_btn .= '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="upload" value="1">
    <input type="hidden" name="business" value="you@youremail.com">';

	$i = 0;

	foreach ($_SESSION["cart_array"] as $each_item) {

		$item_id = $each_item["item_id"];


		$sql = mysql_query("SELECT * FROM nfy_sims WHERE sims_id = $item_id");

			while ($row = mysql_fetch_array($sql)) {
				
				$ber = $row['sims_ber'];
        $berTotal = $row['sims_total'];
        $provider = $row['sims_provider'];
				$price = $row['sims_price'];
			}



		$totalPrice = $price * $each_item['quantity'];
		$cartTotal = $price + $cartTotal;
    $simsOrder = $i + 1;

    $x = $i + 1;
    $pp_checkout_btn .= '<input type="hidden" name="item_name_' . $x . '" value="' . $ber . '">
        <input type="hidden" name="amount_' . $x . '" value="' . $price . '">
        <input type="hidden" name="quantity_1" value="' . $each_item['quantity'] . '">  ';
    // Create the product array variable
    $product_id_array .= "$item_id-".$each_item['quantity'].","; 

    // cartoutput variable

		$cartOutput .= '<tr>';
		$cartOutput .= '<td>' . $simsOrder . '</td>';
		$cartOutput .= '<td>' . $ber . '</td>';
		$cartOutput .= '<td>' . $berTotal . '</td>';
		$cartOutput .= '<td>' . $provider . '</td>';
		$cartOutput .= '<td>' . number_format($price) . '</td>';
		// $cartOutput .= '<td><form action="cart.php" method="post"><input name="deleteBtn'. $item_id . '" type="submit" value="X"><input type="hidden" name="index_to_remove" value="'. $i .'"></form></td>';
    $cartOutput .= '<td><a href="?index_to_remove=' .$i . '">X</a></td>';

		$cartOutput .= '</tr>';



		
		$i++;

	} //endforeach

  $cartOutput .= '</tbody>';
  $cartOutput .= '</table>';
  $pp_checkout_btn .= '<input type="hidden" name="custom" value="' . $product_id_array . '">
  <input type="hidden" name="notify_url" value="https://www.yoursite.com/storescripts/my_ipn.php">
  <input type="hidden" name="return" value="https://www.yoursite.com/checkout_complete.php">
  <input type="hidden" name="rm" value="2">
  <input type="hidden" name="cbt" value="Return to The Store">
  <input type="hidden" name="cancel_return" value="https://www.yoursite.com/paypal_cancel.php">
  <input type="hidden" name="lc" value="US">
  <input type="hidden" name="currency_code" value="USD">
  <input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" name="submit" alt="Make payments with PayPal - its fast, free and secure!">
  </form>';


} //endif


?>
<?php include("template_elements/template_header.php");?>
  <?php  $_SESSION['total'] = $cartTotal ;?>
  <div class="main-container">
    <div class="container">
      <div class="row">
        <div class="col-md-9 page-content">
          <div class="inner-box category-content">
            <h2 class="title-2 uppercase"><strong> <i class="icon-basket"></i> ตะกร้าสินค้า</strong> </h2>
            <div class="row">
              <div class="col-sm-12">
                <form class="form-horizontal">
                  <fieldset>
                    <!-- Select Basic -->
                    <div class="well">
                      <h3><i class="icon-info icon-color-1"></i> รายการสั่งซื้อสินค้าของคุณ </h3>
                      <p>คุณสั่งซื้อในสถานะ: <span style="color: blue;"><?php if ($_SESSION['Memberx']) {
                        echo "ระดับสมาชิก";
                      }else{
                        echo "ทั่วไป";
                        } ?></span>- หมายความว่า หลังจากคุณกดสั่งซื้อซิมเบอร์โทรศัพท์ คุณจำเป็นต้องกรอกข้อมูล และที่อยู่จัดส่งเป็นขั้นตอนถัดไป..
                      <a href="help.html">[คู่มือการสั่งซื้อ]</a></p>
                    	<div class="form-group">
					<!-- <div class="col-md-8">-->
					      	      <table class="table table-hover checkboxtable">
                          <tbody>
                    <?php if ($_SESSION["cart_array"]): ?>
                            <thead>
                              <tr>
                                <th>ซิมอันที่</th>
                                <th>หมายเลข</th>
                                <th>ผลรวม</th>
                                <th>เครือข่าย</th>
                                <th>ราคา (บาท)</th>
                                <th>ลบ</th>
                              </tr>
                            </thead>
                    <?php endif ?>

                    <?php  echo $cartOutput; ?>

                    <!-- buttons -->
                    <?php if ($_SESSION["cart_array"]): ?>

						        <div class="form-group">
                      <div class="col-md-5 col-md-offset-1">
                          <!--<select class="form-control" name="Method" id="PaymentMethod">
                                <option value="2">เลือกวิธีชำระเงิน</option>
                                <option value="3">Credit / Debit Card </option>
                                <option value="5">Paypal</option>
                          </select> -->
                      </div>
                      <div class="col-md-4 col-md-offset-2"><p> <strong>ค่าจัดส่ง : ฟรี! <span style="color: red;">[EMS]</span></strong></p></div>
                      <div class="col-md-4 col-md-offset-8"><p> <strong>ยอดชำระ : <?php echo number_format($cartTotal) . " บาท"; ?></strong></p></div>
                    </div>
                  <?php endif ?>

						</div>
					<!-- close formgroup -->
                    <!-- </div> -->
                    </div>  
                    <!-- close well -->
                    <!-- Button  -->
                    <div class="form-group">
                       <div class="col-md-3"><a href="index.php" class="btn btn-success btn-lg">เลือกสินค้าต่อ</a></div>
                      
                    <?php if (isset($_SESSION["cart_array"]) && $_SESSION["cart_array"] != "") { 
            

                     echo  '<div class="col-md-3"><a href="?addOrder=accept" class="btn btn-success btn-lg">ขั้นตอนต่อไป</a></div>';
                    

                    }

                    ?>
                    </div>
                  </fieldset>
                </form>
                                    <?php echo $pp_checkout_btn; ?>

              </div>
            </div>
          </div>

          <?php if (isset($_GET["addOrder"]) && $_GET["addOrder"] == "accept"): ?>

          <div class="inner-box category-content">
            <h2 class="title-2"> <i class="icon-user-add"></i> กรอกข้อมูลเพื่อจัดส่งสินค้า</h2>
            <div class="row">
              <div class="col-sm-12">
                <form class="form-horizontal" action="checkout.php" method="post">
                  <fieldset>
                    
                    <!-- Text input-->
                    <div class="form-group required">
                      <label class="col-md-4 control-label" >ชื่อ <sup>*</sup></label>
                      <div class="col-md-6">
                        <input  name="cname" placeholder="กรอกชื่อ" class="form-control input-md" required type="text">
                      </div>
                    </div>
                    
                    <!-- Text input-->
                    <div class="form-group required">
                      <label class="col-md-4 control-label" >นามสกุล <sup>*</sup></label>
                      <div class="col-md-6">
                        <input  name="clastname" placeholder="กรอกนามสกุล" class="form-control input-md" required type="text">
                      </div>
                    </div>
                    
                    <!-- Text input-->
                    <div class="form-group required">
                      <label class="col-md-4 control-label" >เบอร์โทรศํพท์<sup>*</sup></label>
                      <div class="col-md-6">
                        <input  name="cber" placeholder="เบอร์โทรศัพท์ที่สามารถติดต่อได้" class="form-control input-md"  required type="text">
                      </div>
                    </div>
                    
                    <!-- Multiple Radios -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" >เพศ</label>
                      <div class="col-md-6">
                        <div class="radio">
                          <label for="Gender-0">
                            <input name="csex" id="Gender-0" value="1" checked="checked" type="radio">
                            ชาย </label>
                        </div>
                        <div class="radio">
                          <label for="Gender-1">
                            <input name="csex" id="Gender-1" value="2" type="radio">
                            หญิง</label>
                        </div>
                      </div>
                    </div>
                    
                    <!-- Textarea -->
                    <div class="form-group required">
                      <label class="col-md-4 control-label">ที่อยู่สำหรับจัดส่งสินค้า<sup>*</sup></label>
                      <div class="col-md-6">
                        <textarea class="form-control" id="textarea" name="caddress" placeholder="กรอกที่อยู่สำหรับการจัดส่งสินค้า" required></textarea>
                      </div>
                    </div>
                    <div class="form-group required">
                      <label for="inputEmail3" class="col-md-4 control-label">อีเมล <sup>*</sup></label>
                      <div class="col-md-6">
                        <input type="text" name="cemail" class="form-control" id="inputEmail3" placeholder="กรอก Email" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label  class="col-md-4 control-label"></label>
                      <div class="col-md-8">

                        <div style="clear:both"></div>
                        <input class="btn btn-primary" type="submit" value="สั่งซื้อ"> 
                      </div>
                    </div>
                  </fieldset>
                </form>
                <!-- /form send vars..-->
              </div>
            </div>
          </div>

          <?php endif ?>
          <!-- /form input confirm order -->
        </div>
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
<?php ob_end_flush(); ?>