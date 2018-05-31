<?php  error_reporting(0); 
    session_start(); 
    include ('module/connect.php');
    include ('module/function.php');?>
<?php include("elements/header.php");?>

        <script language="javascript">
            function CheckValue(){
                if(document.getElementById('ber').value == ""){
                alert('กรุณากรอกเบอร์โทรศัพท์');
                document.getElementById('ber').focus();
                return false;
            }
                if(document.getElementById('ber_price').value == ""){
                alert('ไม่ได้ใส่ราคา');
                document.getElementById('ber_price').focus();
                return false;
            }
        }
        </script>

<?php 
        $Act = $_GET['Act'];
        $id = $_GET['id'];
        $pid = $_GET['pid'];

        switch ($Act) {
            case 'logout':
                session_destroy();
                echo "<script language=\"javascript\">";
                echo "alert('คุณลงชื่ออกจากระบบเรียบร้อยแล้ว');";
                echo "window.location='index.php';";
                echo "</script>";
                exit();

                break;
            
            default:
                
                break;
        }

    ?>

<?php
    if(!isset($_SESSION['Admin'])){
        echo "<script language=\"javascript\">";
        echo "alert('กรุณาล๊อคอินเข้าสู้ระบบ');";
        echo "window.location='index.php';";
        echo "</script>";
    }else{
?>
    <body class="bootstrap-admin-with-small-navbar">
        <!-- small navbar -->
<?php include("elements/small_nav.php"); ?>

        <!-- main / large navbar -->
<?php include("elements/big_nav.php"); ?>


        <div class="container">
            <!-- left, vertical navbar & content -->
            <div class="row">
                <!-- left, vertical navbar -->

                <!-- content -->
                <div class="col-md-12">

                    <div class="row">

                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Master Sim 1.0</div>
                                </div>
                                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">

                            <?php 

                                $sql = "Select * from nfy_sims where sims_id = $id";
                                $r = mysql_query($sql);
                                while ($simsinfo = mysql_fetch_array($r)) {

                            ?>

                                    <form class="form-horizontal" action="editSims.php" method="post">
                                        <fieldset>
                                            <legend>-:- แก้ไขเบอร์โทรศัพท์ -:-</legend>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" >เบอร์โทรศัพท์ </label>
                                                <div class="col-lg-10">
                                                    <input type="text" value="<?php echo $simsinfo['sims_ber']; ?>" name="ber" id="ber" class="form-control col-md-6" maxlength="10" size="5">
                                                    <p class="help-block">เป็นตัวเลขเท่านั้น!</p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" >ราคา </label>
                                                <div class="col-lg-10">
                                                    <input type="text" value="<?php echo $simsinfo['sims_price']; ?>" name="ber_price" id="ber_price" class="form-control col-md-6" maxlength="10" size="5">
                                                    <p class="help-block">กำหนดราคาสำหรับจำหน่าย</p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="optionsCheckbox">แสดงในหน้าแรก</label>
                                                <div class="col-lg-10">
                                                    <label class="uniform">
                                                        <input class="uniform_on" name="ber_show" <?php if ($simsinfo['sims_show'] == 1) {
                                                            echo " checked ";
                                                        }?>type="checkbox" id="optionsCheckbox" value="1">
                                                        คลิกเครื่องหมายถูก&mdash;เบอร์โทรดังกล่าวจะแสดงที่หน้าแรกทันที
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="select01">เครือข่าย</label>
                                                <div class="col-lg-10">
                                                    <select name="ber_pro" id="select01" class="chzn-select" style="width: 150px">
                                                    <?php  
                                                    $simpro = $simsinfo['sims_provider'];
                                                    switch ($simpro) {
                                                        case 'ais':
                                                            $v = 1;
                                                            break;
                                                        case 'truemove':
                                                            $v = 2;
                                                            break;
                                                        case 'dtac':
                                                            $v = 3;
                                                            break;
                                                        
                                                        default:
                                                            $v = 0;
                                                            break;
                                                    }
                                                    ?>
                                                    <?php

                                                        echo '<option value="'. $v .'">'. $simpro .'</option>';

                                                    ?>
                                                        <option value="1">AIS</option>
                                                        <option value="2">TRUEMOVE</option>
                                                        <option value="3">DTAC</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="select01">หมวดหมู่</label>
                                                <div class="col-lg-10">
                                                    <select name="ber_cat" id="select01" class="chzn-select" style="width: 150px; color: black;">
                                                        <option>
                                                        <?php  
                                                                $catnameid = $simsinfo['sims_cat'];

                                                                $sql = "SELECT * FROM nfy_cats";
                                                                $r = mysql_query($sql);
                                                                while ($a = mysql_fetch_array($r)) {

                                                                    if ($catnameid == $a['id']) {

                                                                        echo '<option value="'. $a['id'].'" selected>' . $a['catname'] .'</option>';
                                                                        
                                                                    }else{

                                                                        echo '<option value="'. $a['id'].'" >' . $a['catname'] .'</option>';

                                                                    }

                                                                }
                                                        ?>
                                                        </option>

                                                    </select>
                                                </div>
                                            </div>
                                            <input type="hidden" name="ber_id" value="<?php echo $id; ?>">
                                            <button type="submit" class="btn btn-primary" onclick="return CheckValue()">ตกลง</button>
                                            <button type="reset" class="btn btn-default">ยกเลิก</button>
                                        </fieldset>
                                    </form>

                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- table fetch array-->
                </div>

                </div>
            </div>
        </div>
<?php } ?>
         <!-- footer -->
<?php include("elements/footer.php"); ?>